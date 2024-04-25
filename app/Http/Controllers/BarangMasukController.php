<?php

namespace App\Http\Controllers;

use App\Imports\MasukImport;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Packaging;
use App\Models\RakGudang;
use App\Models\Stock;
use App\Models\StockBarang;
use App\Models\Supplier;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BarangMasukController extends Controller
{
    public function dataMasuk()
    {
        $brgmasuk = BarangMasuk::orderBy('tanggal_masuk', 'desc')->paginate(15);
        $supp = Supplier::all();
        $brg = Barang::all();
        $rak = RakGudang::all();
        $pcr = Packaging::all();
        return view('barang.barangMasuk', ['brgmasuk' => $brgmasuk, 'rak' => $rak, 'supp' => $supp, 'brg' => $brg, 'pcr' => $pcr]);
    }

    public function brgMasuk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_penerimaan' => 'required',
            // 'tanggal_masuk' => 'required',
            // 'id_supplier' => 'required',
            // 'NoSuratJalanMasuk_NoProduksi' => 'required',
            // 'NoPO_NoWO' => 'required',
            // 'kategori_barang' => 'required',
            // 'FAI_code' => 'required',
            // 'no_LOT' => 'required',
            // 'tanggal_produksi' => 'required',
            // 'tanggal_expire' => 'required',
            // 'coa_documentation' => 'required_without_all:tds_documentation,msds_documentation',
            // 'tds_documentation' => 'required_without_all:coa_documentation,msds_documentation',
            // 'msds_documentation' => 'required_without_all:coa_documentation,tds_documentation',
            // 'qty_masuk_LOT' => 'required',
            // 'unit' => 'required',
            // 'jenis_kemasan' => 'required',
            // 'satuan_QTY_kemasan' => 'required',
            // 'total_QTY_kemasan' => 'required',
            // 'status' => 'required',
            // 'id_rak' => 'required',
            // 'file' => 'nullable|file|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect('your-form-route')
                ->withErrors($validator)
                ->withInput();
        }

        $documentation = implode(',', $request->only(['coa_documentation', 'tds_documentation', 'msds_documentation']));

        $barangMasuk = new BarangMasuk([
            'jenis_penerimaan' => $request->jenis_penerimaan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'id_supplier' => $request->id_supplier,
            'NoSuratJalanMasuk_NoProduksi' => $request->NoSuratJalanMasuk_NoProduksi,
            'NoPO_NoWO' => $request->NoPO_NoWO,
            'kategori_barang' => $request->kategori_barang,
            'FAI_code' => $request->FAI_code,
            'no_LOT' => $request->no_LOT,
            'tanggal_produksi' => $request->tanggal_produksi,
            'tanggal_expire' => $request->tanggal_expire,
            'dokumen' => $documentation,
            'qty_masuk_LOT' => $request->qty_masuk_LOT,
            'unit' => $request->unit,
            'jenis_kemasan' => $request->jenis_kemasan,
            'satuan_QTY_kemasan' => $request->satuan_QTY_kemasan,
            'total_QTY_kemasan' => $request->total_QTY_kemasan,
            'status' => $request->status,
            'id_rak' => $request->id_rak,

        ]);

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file);
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('file_masuk'), $fileName);
            $barangMasuk->file[] = '/file_masuk/' . $fileName;
        }

        $rakGudang = RakGudang::find($request->id_rak);

        if ($rakGudang->kapasitas >= $request->qty_masuk_LOT) {
            $rakGudang->kapasitas -= $request->qty_masuk_LOT;
            $rakGudang->save();

            $stock = new Stock([
                'FAI_code' => $request->FAI_code,
                'no_LOT' => $request->no_LOT,
                'tanggal_produksi' => $request->tanggal_produksi,
                'tanggal_expire' => $request->tanggal_expire,
                'unit' => $request->unit,
                'quantity' => $request->qty_masuk_LOT,
                'id_rak' => $request->id_rak,
                'jumlah_kemasan' => $request->total_QTY_kemasan,
                'jenis_kemasan' => $request->jenis_kemasan,

            ]);

            try {
                $stock->save();
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }


            try {
                $barangMasuk->save();
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }

            // Retrieve additional information from the Barang table
            $barangAspect = Barang::where('FAI_code', $request->FAI_code)->value('aspect');
            $productName = Barang::where('FAI_code', $request->FAI_code)->value('name');

            // Check if the FAI_code already exists in the stock_barang table
            $existingStock = StockBarang::where('FAI_code', $request->FAI_code)->first();

            // If the FAI_code exists, update the quantity; otherwise, create a new entry
            if ($existingStock) {
                $existingStock->update([
                    'aspect' => $barangAspect,
                    'product_name' => $productName,
                ]);
            } else {
                $stockBarang = new StockBarang([
                    'FAI_code' => $request->FAI_code,
                    'FINA_code' => $request->FAI_code,
                    'product_name' => $productName,
                    'aspect' => $barangAspect,
                    'category' => $request->kategori_barang,
                    'unit' => $request->unit,
                ]);

                try {
                    $stockBarang->save();
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Failed to save Stock Barang: ' . $e->getMessage());
                }
            }
            session()->flash('success', 'Data telah Ditambahkan!');
            return redirect('barangMasuk')->with('success', 'Barang masuk successfully.');
        } else {
            session()->flash('error', 'Kapasitas Rak tidak mencukupi');
            return redirect('barangMasuk');
        }
    }

    public function updateBarangMasuk(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'jenis_penerimaan' => 'required',
            // 'tanggal_masuk' => 'required',
            // 'id_supplier' => 'required',
            // 'NoSuratJalanMasuk_NoProduksi' => 'required',
            // 'NoPO_NoWO' => 'required',
            // 'kategori_barang' => 'required',
            // 'FAI_code' => 'required',
            // 'no_LOT' => 'required',
            // 'tanggal_produksi' => 'required',
            // 'tanggal_expire' => 'required',
            // 'coa_documentation' => 'required_without_all:tds_documentation,msds_documentation',
            // 'tds_documentation' => 'required_without_all:coa_documentation,msds_documentation',
            // 'msds_documentation' => 'required_without_all:coa_documentation,tds_documentation',
            'qty_masuk_LOT' => 'required',
            // 'unit' => 'required',
            // 'jenis_kemasan' => 'required',
            // 'satuan_QTY_kemasan' => 'required',
            // 'total_QTY_kemasan' => 'required',
            'status' => 'required',
            'id_rak' => 'required',
        ]);
        // dd($validator, $id);
        if ($validator->fails()) {
            return redirect()->route('barangMasuk', $id)  // Ganti 'your-form-route.edit' dengan nama route untuk form edit
                ->withErrors($validator)
                ->withInput();
        }

        $documentation = implode(',', $request->only(['coa_documentation', 'tds_documentation', 'msds_documentation']));

        $barangMasuk = BarangMasuk::find($id);

        $qty_asal = BarangMasuk::where('id_penerimaan', $id)->value('qty_masuk_LOT');

        $qty_baru = $request->qty_masuk_LOT;

        if (!$barangMasuk) {
            return redirect('barangMasuk')->with('error', 'Data barang masuk tidak ditemukan.');
        }

        // Update properties
        $barangMasuk->jenis_penerimaan = $request->jenis_penerimaan;
        $barangMasuk->tanggal_masuk = $request->tanggal_masuk;
        $barangMasuk->id_supplier = $request->id_supplier;
        $barangMasuk->NoSuratJalanMasuk_NoProduksi = $request->NoSuratJalanMasuk_NoProduksi;
        $barangMasuk->NoPO_NoWO = $request->NoPO_NoWO;
        $barangMasuk->kategori_barang = $request->kategori_barang;
        $barangMasuk->FAI_code = $request->FAI_code;
        $barangMasuk->no_LOT = $request->no_LOT;
        $barangMasuk->tanggal_produksi = $request->tanggal_produksi;
        $barangMasuk->tanggal_expire = $request->tanggal_expire;
        $barangMasuk->dokumen = $documentation;
        $barangMasuk->qty_masuk_LOT = $qty_baru;
        $barangMasuk->unit = $request->unit;
        $barangMasuk->jenis_kemasan = $request->jenis_kemasan;
        $barangMasuk->satuan_QTY_kemasan = $request->satuan_QTY_kemasan;
        $barangMasuk->total_QTY_kemasan = $request->total_QTY_kemasan;
        $barangMasuk->status = $request->status;
        $barangMasuk->id_rak = $request->id_rak;


        $rakGudang = RakGudang::find($request->id_rak);
        $rak_asal = BarangMasuk::where('id_penerimaan', $id)->value('id_rak');

        $rg_asal = RakGudang::find($rak_asal);

        if ($rak_asal == $request->id_rak) {
            $rakGudang->kapasitas += $qty_asal;
            $rakGudang->kapasitas -= $request->qty_masuk_LOT;
            $rakGudang->save();
        } else {
            $rg_asal->kapasitas += $qty_asal;
            $rakGudang->kapasitas -= $request->qty_masuk_LOT;
            $rakGudang->save();
        }

        try {
            $barangMasuk->save();
        } catch (\Exception $e) {
            return redirect()->route('your-form-route.edit', $id)
                ->with('error', 'Gagal menyimpan perubahan: ' . $e->getMessage());
        }

        $stock = Stock::where('FAI_code', $request->FAI_code)
            ->where('no_LOT', $request->no_LOT)
            ->first();

        if ($stock) {
            // Update properties
            $stock->tanggal_produksi = $request->tanggal_produksi;
            $stock->tanggal_expire = $request->tanggal_expire;
            $stock->unit = $request->unit;
            $stock->quantity = $request->qty_masuk_LOT;
            $stock->id_rak = $request->id_rak;

            // Simpan perubahan Stock
            try {
                $stock->save();
            } catch (\Exception $e) {
                return redirect()->route('your-form-route.edit', $id)
                    ->with('error', 'Gagal menyimpan perubahan Stock: ' . $e->getMessage());
            }
        }

        // Update StockBarang
        $barangAspect = Barang::where('FAI_code', $request->FAI_code)->value('aspect');
        $productName = Barang::where('FAI_code', $request->FAI_code)->value('name');

        $stockBarang = StockBarang::where('FAI_code', $request->FAI_code)->first();

        if ($stockBarang) {
            // Update properties
            $stockBarang->product_name = $productName;
            $stockBarang->aspect = $barangAspect;
            $stockBarang->category = $request->kategori_barang;
            $stockBarang->unit = $request->unit;

            // Simpan perubahan StockBarang
            try {
                $stockBarang->save();
            } catch (\Exception $e) {
                return redirect()->route('your-form-route.edit', $id)
                    ->with('error', 'Gagal menyimpan perubahan StockBarang: ' . $e->getMessage());
            }
        } else {
            $newStockBarang = new StockBarang([
                'FAI_code' => $request->FAI_code,
                'FINA_code' => $request->FAI_code,
                'product_name' => $productName,
                'aspect' => $barangAspect,
                'category' => $request->kategori_barang,
                'unit' => $request->unit,
            ]);

            try {
                $newStockBarang->save();
            } catch (\Exception $e) {
                return redirect()->route('your-form-route.edit', $id)
                    ->session()->flash('error', 'Data Gagal')
                    ->with('error', 'Gagal menyimpan StockBarang baru: ' . $e->getMessage());
            }
        }

        session()->flash('success', 'Data telah diperbarui!');
        return redirect('barangMasuk')->with('success', 'Data barang masuk berhasil diperbarui.');
    }





    public function storePackage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'nama_kemasan' => 'required',
            'quantity' => 'required',
            // 'supplier' => 'required',
            'jenis_penerimaan' => 'required',
            'tanggal_masuk' => 'required',
            'id_supplier' => 'required',
            'NoSuratJalanMasuk_NoProduksi' => 'required',
            'NoPO_NoWO' => 'required',
            'kategori_barang' => 'required',
            'FAI_code' => 'required',
            'no_LOT' => 'required',
            'tanggal_produksi' => 'required',
            'tanggal_expire' => 'required',
            'coa_documentation' => 'required_without_all:tds_documentation,msds_documentation',
            'tds_documentation' => 'required_without_all:coa_documentation,msds_documentation',
            'msds_documentation' => 'required_without_all:coa_documentation,tds_documentation',
            // 'qty_masuk_LOT' => 'required',
            'unit' => 'required',
            // 'jenis_kemasan' => 'required',
            // 'satuan_QTY_kemasan' => 'required',
            // 'total_QTY_kemasan' => 'required',
            'status' => 'required',
            'id_rak' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('barang')
                ->withErrors($validator)
                ->withInput();
        }

        $documentation = implode(',', $request->only(['coa_documentation', 'tds_documentation', 'msds_documentation']));


        $barangMasuk = new BarangMasuk([
            'jenis_penerimaan' => $request->jenis_penerimaan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'id_supplier' => $request->id_supplier,
            'NoSuratJalanMasuk_NoProduksi' => $request->NoSuratJalanMasuk_NoProduksi,
            'NoPO_NoWO' => $request->NoPO_NoWO,
            'kategori_barang' => $request->kategori_barang,
            'FAI_code' => $request->FAI_code,
            'no_LOT' => $request->no_LOT,
            'tanggal_produksi' => $request->tanggal_produksi,
            'tanggal_expire' => $request->tanggal_expire,
            'dokumen' => $documentation,
            'qty_masuk_LOT' => $request->qty_masuk_LOT,
            'unit' => $request->unit,
            'jenis_kemasan' => $request->jenis_kemasan,
            'satuan_QTY_kemasan' => $request->satuan_QTY_kemasan,
            'total_QTY_kemasan' => $request->quantity,
            'status' => $request->status,
            'id_rak' => $request->id_rak,
        ]);

        $namaKemasan = Packaging::where('FAI_code', $request->FAI_code)->first();

        $existStock = Packaging::where($namaKemasan, $request->nama_kemasan)->first();
        $tambah = Packaging::where('FAI_code', $request->FAI_code)->value('quantity');
        $capacity = Packaging::where('capacity', $request->capacity)->first();

        $capacity2 = Packaging::where('FAI_code', $request->FAI_code)->value('capacity');

        if ($existStock && $capacity) {
            $jumlah = $tambah + $request->quantity;
            $existStock->update([
                'quantity' => $jumlah,
            ]);
        } elseif (!$existStock) {
            $package = new Packaging([
                'FAI_code' => $request->FAI_code,
                'nama_kemasan' => $request->nama_kemasan,
                'capacity' => $capacity2,
                'supplier' => $request->supplier,
                'quantity' => $request->quantity,
                'id_rak' => $request->id_rak,
            ]);
            try {
                $barangMasuk->save();
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
            try {
                $package->save();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to save Packaging: ' . $e->getMessage());
            }
        } else {
            session()->flash('error', 'Kapasitas Rak tidak mencukupi');
            return redirect('barangMasuk');
        }
        session()->flash('success', 'Data telah Ditambahkan!');
        return redirect('barangMasuk')->with('success', 'Barang masuk successfully.');
    }

    public function import_masuk()
    {
        Excel::import(new MasukImport, request()->file('file'));
        return redirect()->back()->with('success', 'Users imported successfully!');
    }
}
