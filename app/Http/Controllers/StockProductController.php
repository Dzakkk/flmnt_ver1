<?php

namespace App\Http\Controllers;

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
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Formula;
use Spatie\Backtrace\File;

class StockProductController extends Controller
{

    public function stock()
    {
        // $stock = stockProduct::all();
        $stock = stockProduct::with('stockLot', 'product')->get();
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
            'jumlah_kemasan' => 'required',
            'jenis_kemasan' => 'required',
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




        session(['FAI_code' => $request->input('FAI_code')]);
        session(['product_name' => $request->input('product_name')]);
        session(['no_LOT' => $request->input('no_LOT')]);
        session(['quantity' => $request->input('quantity')]);
        session(['unit' => $request->input('unit')]);
        session(['tanggal_produksi' => $request->input('tanggal_produksi')]);
        session(['tanggal_expire' => $request->input('tanggal_expire')]);
        session(['id_rak' => $request->input('id_rak')]);
        session(['jumlah_kemasan' => $request->input('jumlah_kemasan')]);
        session(['jenis_kemasan' => $request->input('jenis_kemasan')]);
        session(['no_production' => $request->input('no_production')]);
        session(['no_work_order' => $request->input('no_work_order')]);
        session(['customer_name' => $request->input('customer_name')]);
        session(['customer_code' => $request->input('customer_code')]);
        session(['PO_customer' => $request->input('PO_customer')]);

        return redirect('production/form')->with('success', 'Stock issued successfully.');
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
                ];
            }
        }

        $prd = StockBarang::all();
        $brg = stockProduct::all();

        return view('form.productionControl', compact('FAI_code', 'product_name', 'no_LOT', 'quantity', 'unit', 'customer_name', 'customer_code', 'PO_customer', 'tanggal_produksi', 'tanggal_expire', 'id_rak', 'jumlah_kemasan', 'jenis_kemasan', 'no_production', 'no_work_order', 'FAI_code_barang_array', 'persentase_array', 'barang_array', 'prd', 'brg'));
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
            $rakGudang->kapasitas -= $request->quantity;
            $rakGudang->save();


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
                $percentage = floatval($persentase_array[$index]);
                $hasilPersen = $request->quantity * ($percentage / 100);

                $stl = Stock::where('FAI_code', $FAI_code_barang)->value('id_rak');
                $rakGudang = RakGudang::where('id_rak', $stl)->first();

                if ($rakGudang) {
                    $rakGudang->kapasitas += $hasilPersen;
                    $rakGudang->save();
                }

                $lotStocks = Stock::where('FAI_code', $FAI_code_barang)->get();

                foreach ($lotStocks as $lotStock) {
                    if ($lotStock->quantity >= $hasilPersen) {
                        $lotStock->quantity -= $hasilPersen;
                        $lotStock->save();
                        break;
                    } else {
                        $hasilPersen -= $lotStock->quantity;
                        $lotStock->quantity = 0;
                        $lotStock->save();
                    }
                }
            }

            $pdf = FacadePdf::loadView('form.pControl', compact('FAI_code', 'product_name', 'no_LOT', 'quantity', 'customer_name', 'customer_code', 'PO_customer', 'tanggal_produksi', 'tanggal_expire', 'no_production', 'no_work_order', 'dataArray', 'persentase_array'));
            return $pdf->download('Production_Control.pdf');
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

        return view('formula');
    }

    public function dataProductionControl()
    {
        $pc = ProductionControl::all();

        return view('production.productionControl', ['pc' => $pc]);
    }

    public function afterProduction($id)
    {
        $prc = ProductionControl::find($id);
        $rak = RakGudang::all();
        $packaging_qty = json_decode($prc->packaging_qty, true);
        return view('production.formAfterProduction', ['rak' => $rak, 'prc' => $prc, 'packaging_qty' => $packaging_qty]);
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
}
