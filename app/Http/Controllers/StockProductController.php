<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\CustList;
use App\Models\Customer;
use App\Models\Packaging;
use App\Models\ProductFormula;
use App\Models\ProductionControl;
use App\Models\Products;
use App\Models\RakGudang;
use App\Models\Stock;
use App\Models\StockBarang;
use App\Models\stockProduct;
use App\Models\UsageData;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Formula;
use Spatie\Backtrace\File;
use Svg\Gradient\Stop;

class StockProductController extends Controller
{

    public function stock()
    {
        // $stock = stockProduct::all();
        $stock = stockProduct::with('stockLot', 'qc_check', 'product')->get();
        return view('stock.stockProduct', ['stock' => $stock]);
    }


    private function stockGudang($request)
    {
        $formula = ProductFormula::where('FAI_code', $request->FAI_code)->first();

        if ($formula) {
            $FAI_code_barang_array = json_decode($formula->FAI_code_barang, true);
            $persentase_array = json_decode($formula->persentase, true);

            if (is_array($FAI_code_barang_array) && is_array($persentase_array)) {
                foreach ($FAI_code_barang_array as $index => $FAI_code_barang) {
                    $requestedWeight = $request->quantity;
                    $percentage = floatval($persentase_array[$index]);

                    $hasilPersen = $requestedWeight * ($percentage / 100);

                    $available = Stock::where('FAI_code', $FAI_code_barang)->sum('quantity');

                    if ($hasilPersen > $available) {
                        return false; // Kembalikan false jika stok tidak mencukupi
                    }
                }
            }
        }

        return true;
    }


    public function storeProduction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'FAI_code' => 'required',
            'product_name' => 'required',
            'id_rak' => 'required',
            'quantity' => 'required',
            'unit' => 'required',
            'tanggal_produksi' => 'required',
            'tanggal_expire' => 'required',
            'no_LOT' => 'required',
            // 'jumlah_kemasan' => 'required',
            'jenis_kemasan' => 'required',
            // 'customer_name' => 'required',
            'customer_code' => 'required',
            'no_production' => 'required',
            'no_work_order' => 'required',
            'PO_customer' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('formula')
                ->withErrors($validator)
                ->withInput();
        }


        $kms = Packaging::where('FAI_code', $request->jenis_kemasan)->value('nama_kemasan');
        $cpc = Packaging::where('FAI_code', $request->jenis_kemasan)->value('capacity');

        $jmlKs = $request->quantity / $cpc;

        $cust = CustList::where('customer_code', $request->customer_code)->value('customer_name');

        session(['FAI_code' => $request->input('FAI_code')]);
        session(['product_name' => $request->input('product_name')]);
        session(['no_LOT' => $request->input('no_LOT')]);
        session(['quantity' => $request->input('quantity')]);
        session(['unit' => $request->input('unit')]);
        session(['tanggal_produksi' => $request->input('tanggal_produksi')]);
        session(['tanggal_expire' => $request->input('tanggal_expire')]);
        session(['id_rak' => $request->input('id_rak')]);
        session(['jumlah_kemasan' => $jmlKs]);
        session(['jenis_kemasan' => $kms]);
        session(['no_production' => $request->input('no_production')]);
        session(['no_work_order' => $request->input('no_work_order')]);
        session(['customer_name' => $request->input('customer_name')]);
        session(['customer_code' => $request->input('customer_code')]);
        session(['PO_customer' => $request->input('PO_customer')]);

        return redirect('production/form')->with('success', 'redirect.');
    }

    public function productionControl()
    {
        $FAI_code = session('FAI_code');
        $product_name = session('product_name');
        $no_LOT = session('no_LOT');
        $quantity = session('quantity');
        $unit = session('unit');
        $customer_name = session('customer_name');
        $customer_code = session('customer_code');
        $PO_customer = session('PO_customer');
        $tanggal_produksi = session('tanggal_produksi');
        $tanggal_expire = session('tanggal_expire');
        $id_rak = session('id_rak');
        $jumlah_kemasan = session('jumlah_kemasan');
        $jenis_kemasan = session('jenis_kemasan');
        $no_production = session('no_production');
        $no_work_order = session('no_work_order');

        $formula = ProductFormula::where('FAI_code', $FAI_code)->first();

        $nama_barang_array = [];

        if ($formula) {
            $FAI_code_barang_array = json_decode($formula->FAI_code_barang, true);
            $persentase_array = json_decode($formula->persentase, true);

            foreach ($FAI_code_barang_array as $FAI_code_barang) {
                $stock_barang = StockBarang::where('FAI_code', $FAI_code_barang)->first();
                $stock_LOT = Stock::where('FAI_code', $FAI_code_barang)->value('no_LOT');
                $stock = Stock::where('FAI_code', $FAI_code_barang)->sum('quantity');
                $stock_product = StockProduct::where('FAI_code', $FAI_code_barang)->first();

                if ($stock_barang) {
                    $nama_barang = $stock_barang->product_name;
                } elseif ($stock_product) {
                    $nama_barang = $stock_product->product_name;
                } else {
                    $nama_barang = null;
                }

                $barang_array[] = [
                    'FAI_code_barang' => $FAI_code_barang,
                    'product_name' => $nama_barang,
                    'no_LOT' => $stock_LOT,
                    'stock' => $stock,
                ];
            }
        }

        $prd = StockBarang::all();
        $brg = stockProduct::all();

        return view('form.productionControl', compact('FAI_code', 'product_name', 'no_LOT', 'stock', 'quantity', 'unit', 'customer_name', 'customer_code', 'PO_customer', 'tanggal_produksi', 'tanggal_expire', 'id_rak', 'jumlah_kemasan', 'jenis_kemasan', 'no_production', 'no_work_order', 'FAI_code_barang_array', 'persentase_array', 'barang_array', 'prd', 'brg'));
    }


    public function productProduction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'FAI_code' => 'required',
            'product_name' => 'required',
            'quantity' => 'required',
            'tanggal_produksi' => 'required',
            'no_LOT' => 'required',
            'customer_name' => 'required',
            'customer_code' => 'required',
            'no_production' => 'required',
            'no_work_order' => 'required',
            'PO_customer' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('formula')
                ->withErrors($validator)
                ->withInput();
        }

        $dataArray = $request->input('FAI_code_barang');
        $persentase_array = $request->input('persentase_array');

        // dd($dataArray);

        $FAI_code = $request->input('FAI_code');
        $product_name = $request->input('product_name');
        $no_LOT = $request->input('no_LOT');
        $quantity = $request->input('quantity');
        $customer_name = $request->input('customer_name');
        $customer_code = $request->input('customer_code');
        $PO_customer = $request->input('PO_customer');
        $tanggal_produksi = $request->input('tanggal_produksi');
        $no_production = $request->input('no_production');
        $no_work_order = $request->input('no_work_order');


        $id_rak = session('id_rak');
        $jumlah_kemasan = session('jumlah_kemasan');
        $jenis_kemasan = session('jenis_kemasan');
        $tanggal_expire = session('tanggal_expire');
        $unit = session('unit');

        $production = new Stock([
            'FAI_code' => $request->FAI_code,
            'no_LOT' => $request->no_LOT,
            'quantity' => $request->quantity,
            'unit' => $unit,
            'tanggal_produksi' => $request->tanggal_produksi,
            'tanggal_expire' => $tanggal_expire,
            'id_rak' => $id_rak,
            'jumlah_kemasan' => $jumlah_kemasan,
            'jenis_kemasan' => $jenis_kemasan,
            'no_production' => $request->no_production,
            'no_work_order' => $request->no_work_order,
        ]);

        try {
            $production->save();

            $rakGudang = RakGudang::where('id_rak', $id_rak)->firstOrFail();

            if ($rakGudang->kapasitas >= $request->quantity) {
                $rakGudang->kapasitas -= $request->quantity;
                $rakGudang->save();
            } else {
                session()->flash('error', 'gudang Penuh');
                return redirect('production/form')->with('error', 'Gudang Penuh');
            }

            $barangMasuk = new BarangMasuk([
                'FAI_code' => $request->FAI_code,
                'jenis_penerimaan' => 'Bahan Hasil Produksi',
                'tanggal_masuk' => now(),
                'tanggal_produksi' => $request->tanggal_produksi,
                'tanggal_expire' => $tanggal_expire,
                'NoSuratJalanMasuk_NoProduksi' => $request->no_production,
                'unit' => $unit,
                'no_LOT' => $no_LOT,
                'qty_masuk_LOT' => $quantity,
                'NoPO_NoWO' => $PO_customer + '/' + $no_work_order,
                'id_rak' => $id_rak,
                'jenis_kemasan' => $jenis_kemasan,
                'jumlah_kemasan' => $jumlah_kemasan,

            ]);

            $barangMasuk->save();


            $newCust = Customer::where('customer_name', $request->customer_name)->first();

            if ($newCust) {
                $cust = CustList::where('customer_name', $request->customer_name)
                    ->where('customer_code', $request->customer_code)
                    ->first();

                if (!$cust) {
                    $custList = new CustList([
                        'customer_name' => $request->customer_name,
                        'customer_code' => $request->customer_code,
                        'FAI_code' => $request->FAI_code,
                        'PO_customer' => $request->PO_customer,
                        'id_customer' => Customer::where('customer_name', $request->customer_name)->value('id_customer'),
                    ]);
                    $custList->save();
                }
            } elseif (!$newCust) {
                $custNew = new Customer([
                    'customer_name' => $request->customer_name,
                ]);
                $custNew->save();
            }

            $cust = CustList::where('customer_name', $request->customer_name)
                ->first();

            if (!$cust) {
                $custList = new CustList([
                    'customer_name' => $request->customer_name,
                    'customer_code' => $request->customer_code,
                    'FAI_code' => $request->FAI_code,
                    'PO_customer' => $request->PO_customer,
                    'id_customer' => Customer::where('customer_name', $request->customer_name)->value('id_customer'),
                ]);
                $custList->save();
            }

            $prd = stockProduct::where('FAI_code', $request->FAI_code)->first();
            $aspect = Products::where('FAI_code', $request->FAI_code)->value('aspect');
            $ctgry = Products::where('FAI_code', $request->FAI_code)->value('category');
            if (!$prd) {
                $prdNew = new stockProduct([
                    'FAI_code' => $request->FAI_code,
                    'FINA_code' => $request->FAI_code,
                    'product_name' => $request->product_name,
                    'aspect' => $aspect,
                    'category' => $ctgry,
                    'unit' => $unit,
                ]);
                $prdNew->save();
            }

            $production_control = new productionControl([
                'no_production' => $request->no_production,
                'FAI_code' => $request->FAI_code,
            ]);

            $production_control->save();

            $kemasan = Packaging::where('nama_kemasan', $jenis_kemasan)->firstOrFail();
            $kemasan->quantity -= $request->quantity;
            $kemasan->save();

            foreach ($dataArray as $index => $FAI_code_barang) {
                $hasilPersen = floatval($persentase_array[$index]);
                // $hasilPersen = $request->quantity * ($percentage / 100);

                $stl = Stock::where('FAI_code', $FAI_code_barang)->value('id_rak');
                $rakGudang = RakGudang::where('id_rak', $stl)->first();

                if ($rakGudang) {
                    $rakGudang->kapasitas += $hasilPersen;
                    $rakGudang->save();
                }

                $usage = new UsageData([
                    'pemakaian' => $hasilPersen,
                    'FAI_code' => $FAI_code_barang,
                    'tanggal_penggunaan' => $request->tanggal_produksi,
                ]);

                $usage->save();


                $lotStocks = Stock::where('FAI_code', $FAI_code_barang)
                    ->orderBy('tanggal_masuk', 'asc')
                    ->get();

                // Inisialisasi sisa persentase yang belum diproses
                $remainingPercentage = $hasilPersen;

                // Iterasi melalui setiap entri FAI code
                foreach ($lotStocks as $lotStock) {
                    // Menghitung jumlah yang akan dikurangkan dari entri stok saat ini
                    $quantityToReduce = min($lotStock->quantity, $remainingPercentage);

                    // Menyimpan perubahan stok
                    $stockChanges[] = [
                        'id_lot' => $lotStock->id_lot,
                        'quantity' => $quantityToReduce,
                    ];

                    $barangKeluar = new BarangKeluar([
                        'FAI_code' => $FAI_code_barang,
                        'jumlah_keluar' => $quantityToReduce,
                        'tanggal_keluar' => $request->tanggal_produksi,
                        'id_lot' => $lotStock->id_lot,
                    ]);
                    $barangKeluar->save();

                    // Mengurangi sisa persentase yang belum diproses
                    $remainingPercentage -= $quantityToReduce;

                    // Hentikan iterasi jika sisa persentase yang belum diproses sudah 0
                    if ($remainingPercentage <= 0) {
                        break;
                    }
                }
            }

            foreach ($stockChanges as $change) {
                $stock = Stock::find($change['id_lot']);
                $stock->quantity -= $change['quantity'];
                $stock->save();
            }

            $pdf = FacadePdf::loadView('form.pControl', compact('FAI_code', 'product_name', 'no_LOT', 'quantity', 'customer_name', 'customer_code', 'PO_customer', 'tanggal_produksi', 'tanggal_expire', 'no_production', 'no_work_order', 'dataArray', 'persentase_array', 'jenis_kemasan', 'jumlah_kemasan'));
            return $pdf->stream('Production_Control.pdf');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal: ' . $e->getMessage());
            return redirect('formula')->with('error', 'Gagal: ' . $e->getMessage());
        }
        session()->flash('success', 'Berhasil');
        $this->pindah();
        return redirect('formula')->with('success', 'Unduhan PDF berhasil, Anda telah dialihkan.');
    }

    private function pindah()
    {

        return redirect('formula');
    }

    public function dataProductionControl()
    {
        $pc = ProductionControl::with('product', 'stockl', 'qc_check')->get();

        return view('production.productionControl', ['pc' => $pc]);
    }

    public function afterProduction($id)
    {
        $prc = ProductionControl::find($id);

        $stockl = Stock::with('product')->where('no_production', $prc->no_production)->first();
        $rak = RakGudang::all();
        $packaging_qty = json_decode($prc->packaging_qty, true);
        return view('production.formAfterProduction', ['rak' => $rak, 'prc' => $prc, 'packaging_qty' => $packaging_qty, 'stockl' => $stockl]);
    }


    public function productionAfter(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|file|max:10240',
        ]);

        $data = ProductionControl::findOrFail($id);

        $data->update($request->except('file'));
        if ($request->hasFile('file')) {
            if (FacadesFile::exists(public_path($data->file))) {
                FacadesFile::delete(public_path($data->file));
            }
        }


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();

            $file->move(public_path('images'), $fileName);

            $data->file = '/images/' . $fileName;

            $data->save();
        }
        return redirect('production/control');
    }


    public function updateProductionForm($id)
    {

        $prc = ProductionControl::find($id);

        $stockl = Stock::with('product')->where('no_production', $prc->no_production)->first();
        $rak = RakGudang::all();
        $kemasan = Packaging::all();
        $custList = CustList::all();
        $cust = Customer::all();
        // dd($prc, $stockl);
        return view('production.formUpdateProduction', compact('stockl', 'rak', 'kemasan', 'custList', 'cust'));
    }

    public function updateDataProduction1(Request $request, $id)
    {
        $prc = ProductionControl::find($id);

        $prc->update([
            'no_production' => $request->no_production,
        ]);

        $stockL = Stock::where('no_production', $prc->no_production)->first();

        $stockL->update([
            'no_production' => $request->no_production,
            'tanggal_produksi' => $request->tanggal_produksi,
            'tanggal_expire' => $request->tanggal_expire,
            'no_LOT' => $request->no_LOT,
            'quantity' => $request->quantity,
            'id_rak' => $request->id_rak,
            'jumlah_Kemasan' => $request->jumlah_kemasan,
            'jenis_kemasan' => $request->jenis_kemasan,
        ]);

        $custList = CustList::where('customer_code', $request->customer_code)
            ->where('customer_name', $request->customer_name)
            ->first();

        if (!$custList) {
            $cust = new Customer([
                'customer_name' => $request->customer_name,
            ]);
            $cust->save();
            $custl = new CustList([
                'customer_code' => $request->customer_code,
                'customer_name' => $request->customer_name,
                'PO_customer' => $request->PO_Customer,
                'FAI_code' => $request->FAI_code,
                'id_customer' => Customer::where('customer_name', $request->customer_name)->value('id_customer'),
            ]);
            $custl->save();
        } else {
            $custList->update($request->all());
        }

        return redirect('/production/control/data');
    }

    public function updateDataProduction2(Request $request, $id)
    {
        $prc = ProductionControl::find($id);

        $prc->update([
            'no_production' => $request->no_production,
        ]);

        $stockL = Stock::where('no_production', $prc->no_production)->first();

        $stockL->update($request->all());

        $custList = CustList::where('customer_code', $request->customer_code)
            ->where('customer_name', $request->customer_name)
            ->first();

        if (!$custList) {
            $cust = new Customer([
                'customer_name' => $request->customer_name,
            ]);
            $cust->save();
            $custl = new CustList([
                'customer_code' => $request->customer_code,
                'customer_name' => $request->customer_name,
                'PO_customer' => $request->PO_Customer,
                'FAI_code' => $request->FAI_code,
                'id_customer' => Customer::where('customer_name', $request->customer_name)->value('id_customer'),
            ]);
            $custl->save();
        } else {
            $custList->update($request->all());
        }

        return redirect('/after/production/' . $id);
    }
}
