<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\RakGudang;
use App\Models\Stock;
use App\Models\StockBarang;
use App\Models\Supplier;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator as ValidationValidator;

class BarangMasukController extends Controller
{
    public function dataMasuk()
    {
        $brgmasuk = BarangMasuk::all();
        $supp = Supplier::all();
        $brg = Barang::all();
        $rak = RakGudang::all();
        return view('barang.barangMasuk', ['brgmasuk' => $brgmasuk, 'rak' => $rak, 'supp' => $supp, 'brg' => $brg]);
    }

    //     public function brgMasuk(Request $request)
    // {
    //     $qtyMasuk = $request->input('qty_masuk_LOT');
    //     $documentation = implode(',', $request->only(['coa_documentation', 'tds_documentation', 'msds_documentation']));

    //     // Validate fields with custom rules
    //     $request->validate([
    //         'coa_documentation' => 'required_without_all:tds_documentation,msds_documentation',
    //         'tds_documentation' => 'required_without_all:coa_documentation,msds_documentation',
    //         'msds_documentation' => 'required_without_all:coa_documentation,tds_documentation',
    //         // Add other validation rules for BarangMasuk fields here
    //     ]);

    //     $barangMasuk = new BarangMasuk;
    //     $barangMasuk->fill($request->only([
    //         'tanggal_masuk',
    //         'jenis_penerimaan',
    //         'id_supplier',
    //         'NoSuratJalanMasuk_NoProduksi',
    //         'NoPO_NoWO',
    //         'kategori_barang',
    //         'dokumen',
    //         'FAI_code',
    //         'no_LOT',
    //         'tanggal_produksi',
    //         'tanggal_expire',
    //         'qty_masuk_LOT',
    //         'unit',
    //         'jenis_kemasan',
    //         'satuan_QTY_kemasan',
    //         'total_QTY_kemasan',
    //         'status',
    //         'id_rak',
    //     ]));

    //     // Set 'dokumen' based on checkbox status
    //     $barangMasuk->dokumen = $request->hasAny(['coa_documentation', 'tds_documentation', 'msds_documentation'])
    //         ? 'Yes'
    //         : 'No';


    //     $stock = new Stock;
    //     $stock->fill($request->only([
    //         'FAI_code',
    //         'no_LOT',
    //         'tanggal_produksi',
    //         'tanggal_expire',
    //         'unit',
    //         'weight',
    //     ]));

    //     // Set qty_masuk_LOT and weight to the same value
    //     $stock->qty_masuk_LOT = $qtyMasuk;
    //     $stock->weight = $qtyMasuk;


    //     $barangMasuk->save();

    //     $stock->save();

    //     return redirect('barangMasuk');
    // }

    // public function brgMasuk(Request $request)
    // {
    //     $request->validate([
    //         'jenis_penerimaan' => 'required',
    //         'tanggal_masuk' => 'required',
    //         'id_supplier' => 'required',
    //         'NoSuratJalanMasuk_NoProduksi' => 'required',
    //         'NoPO_NoWO' => 'required',
    //         'kategori_barang' => 'required',
    //         'FAI_code' => 'required',
    //         'no_LOT' => 'required',
    //         'tanggal_produksi' => 'required',
    //         'tanggal_expire' => 'required',
    //         'coa_documentation' => 'required_without_all:tds_documentation,msds_documentation',
    //         'tds_documentation' => 'required_without_all:coa_documentation,msds_documentation',
    //         'msds_documentation' => 'required_without_all:coa_documentation,tds_documentation',
    //         'qty_masuk_LOT' => 'required',
    //         'unit' => 'required',
    //         'jenis_kemasan' => 'required',
    //         'satuan_QTY_kemasan' => 'required',
    //         'total_QTY_kemasan' => 'required',
    //         'status' => 'required',
    //         'id_rak' => 'required',

    //     ]);

    //     // Combine selected documentation checkboxes into a string
    //     $documentation = implode(',', $request->only(['coa_documentation', 'tds_documentation', 'msds_documentation']));

    //     // Create a new BarangMasuk instance and fill it with the request data
    //     $barangMasuk = new BarangMasuk([
    //         'jenis_penerimaan' => $request->jenis_penerimaan,
    //         'tanggal_masuk' => $request->tanggal_masuk,
    //         'id_supplier' => $request->id_supplier,
    //         'NoSuratJalanMasuk_NoProduksi' => $request->NoSuratJalanMasuk_NoProduksi,
    //         'NoPO_NoWO' => $request->NoPO_NoWO,
    //         'kategori_barang' => $request->kategori_barang,
    //         'FAI_code' => $request->FAI_code,
    //         'no_LOT' => $request->no_LOT,
    //         'tanggal_produksi' => $request->tanggal_produksi,
    //         'tanggal_expire' => $request->tanggal_expire,
    //         'dokumen' => $documentation,
    //         'qty_masuk_LOT' => $request->qty_masuk_LOT,
    //         'unit' => $request->unit,
    //         'jenis_kemasan' => $request->jenis_kemasan,
    //         'satuan_QTY_kemasan' => $request->satuan_QTY_kemasan,
    //         'total_QTY_kemasan' => $request->total_QTY_kemasan,
    //         'status' => $request->status,
    //         'id_rak' => $request->id_rak,
    //     ]);

    //     // Save the BarangMasuk instance to insert data into the barang_masuk table
    //     $barangMasuk->save();

    //     // Create a new Stock instance and fill it with the request data
    //     $stock = new Stock([
    //         'FAI_code' => $request->FAI_code,
    //         'no_LOT' => $request->no_LOT,
    //         'tanggal_produksi' => $request->tanggal_produksi,
    //         'tanggal_expire' => $request->tanggal_expire,
    //         'unit' => $request->unit,
    //         'weight' => $request->qty_masuk_LOT, // Assuming qty_masuk_LOT and weight are the same
    //     ]);

    //     // Save the Stock instance to insert data into the stock_lot table
    //     $stock->save();

    //     return redirect('barangMasuk');
    // }

    public function brgMasuk(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
            'qty_masuk_LOT' => 'required',
            'unit' => 'required',
            'jenis_kemasan' => 'required',
            'satuan_QTY_kemasan' => 'required',
            'total_QTY_kemasan' => 'required',
            'status' => 'required',
            'id_rak' => 'required',
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

        $rakGudang = RakGudang::find($request->id_rak);

        if ($rakGudang->kapasitas >= $request->qty_masuk_LOT) {
            // Deduct capacity from the rack
            $rakGudang->kapasitas -= $request->qty_masuk_LOT;
            $rakGudang->save();

            // Create or update the stock entry
            $stock = new Stock([
                'FAI_code' => $request->FAI_code,
                'no_LOT' => $request->no_LOT,
                'tanggal_produksi' => $request->tanggal_produksi,
                'tanggal_expire' => $request->tanggal_expire,
                'unit' => $request->unit,
                'weight' => $request->qty_masuk_LOT,
                'id_rak' => $request->id_rak,

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
            $commonName = Barang::where('FAI_code', $request->FAI_code)->value('common_name');
            $productName = Barang::where('FAI_code', $request->FAI_code)->value('name');

            // Check if the FAI_code already exists in the stock_barang table
            $existingStock = StockBarang::where('FAI_code', $request->FAI_code)->first();

            // If the FAI_code exists, update the quantity; otherwise, create a new entry
            if ($existingStock) {
                $existingStock->update([
                    'quantity' => $existingStock->quantity + $request->qty_masuk_LOT,
                    'aspect' => $barangAspect,
                    'common_name' => $commonName,
                    'product_name' => $productName,
                ]);
            } else {
                $stockBarang = new StockBarang([
                    'FAI_code' => $request->FAI_code,
                    'product_name' => $productName,
                    'common_name' => $commonName,
                    'aspect' => $barangAspect,
                    'category' => $request->kategori_barang,
                    'quantity' => $request->qty_masuk_LOT,
                    'unit' => $request->unit,
                ]);

                try {
                    $stockBarang->save();
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Failed to save Stock Barang: ' . $e->getMessage());
                }
            }

            return redirect('barangMasuk')->with('success', 'Barang masuk successfully.');
        } else {
            return response()->json(['status' => 'error', 'message' => 'Kapasitas rak tidak mencukupi.']);

        }
    }
}
