<?php

namespace App\Http\Controllers;

use App\Models\CustList;
use App\Models\Customer;
use App\Models\Packaging;
use App\Models\ProductFormula;
use App\Models\Products;
use App\Models\RakGudang;
use App\Models\Stock;
use App\Models\StockBarang;
use App\Models\stockProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StockProductController extends Controller
{

    public function stock()
    {
        // $stock = stockProduct::all();
        $stock = stockProduct::with('stockLot', 'product')->get();
        return view('stock.stockProduct', ['stock' => $stock]);
    }

    // private function stockGudang($request)
    // {
    //     $formula = ProductFormula::where('FAI_code', $request->FAI_code)->first();

    //     if ($formula) {
    //         $FAI_code_barang_array = json_decode($formula->FAI_code_barang, true);
    //         $persentase_array = json_decode($formula->persentase, true);

    //         if (is_array($FAI_code_barang_array) && is_array($persentase_array)) {
    //             foreach ($FAI_code_barang_array as $index => $FAI_code_barang) {
    //                 $requestedWeight = $request->quantity;
    //                 $percentage = floatval($persentase_array[$index]);

    //                 $hasilPersen = $requestedWeight * ($percentage / 100);

    //                 $available = Stock::where('FAI_code', $FAI_code_barang)->sum('quantity');

    //                 if ($hasilPersen > $available) {
    //                     return false; // Kembalikan false jika stok tidak mencukupi
    //                 }
    //             }
    //         }
    //     }

    //     return true; // Kembalikan true jika stok mencukupi
    // }

    // public function storeProduction(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'FAI_code' => 'required',
    //         'product_name' => 'required',
    //         'id_rak' => 'required',
    //         'quantity' => 'required',
    //         'unit' => 'required',
    //         'tanggal_produksi' => 'required',
    //         'tanggal_expire' => 'required',
    //         'no_LOT' => 'required',
    //         'jumlah_kemasan' => 'required',
    //         'jenis_kemasan' => 'required',
    //         'customer_name' => 'required',
    //         'customer_code' => 'required',
    //         'no_production' => 'required',
    //         'no_work_order' => 'required',
    //         'jumlah_kemasan' => 'required',
    //         'jenis_kemasan' => 'required',
    //         'PO_customer' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect('formula')
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     if (!$this->stockGudang($request)) {
    //         return redirect('formula')
    //             ->with('error', 'Stock tak ada mas');
    //     }

    //     $production = new Stock([
    //         'FAI_code' => $request->FAI_code,
    //         'no_LOT' => $request->no_LOT,
    //         'quantity' => $request->quantity,
    //         'unit' => $request->unit,
    //         'tanggal_produksi' => $request->tanggal_produksi,
    //         'tanggal_expire' => $request->tanggal_expire,
    //         'id_rak' => $request->id_rak,
    //         'jumlah_kemasan' => $request->jumlah_kemasan,
    //         'jenis_kemasan' => $request->jenis_kemasan,
    //         'no_production' => $request->no_production,
    //         'no_work_order' => $request->no_work_order,
    //     ]);

    //     $rakGudang = RakGudang::where('id_rak', $request->id_rak)->first();

    //     if (!$rakGudang) {
    //         session()->flash('error', 'Gagal');

    //         return redirect('formula')->with('error', 'Rak Gudang not found for the specified FAI_code.');
    //     }
    //     $rakGudang->kapasitas -= $request->quantity;

    //     try {
    //         $rakGudang->save();
    //     } catch (\Exception $e) {
    //         session()->flash('error', 'Gagal');
    //     }

    //     $kemasan = Packaging::where('nama_kemasan', $request->jenis_kemasan)->first();
    //     if (!$kemasan) {
    //         session()->flash('error', 'mau pake apa?');
    //         return redirect('formula')->with('error', 'Mau diwadahin apaan?');
    //     }

    //     $kemasan->quantity -= $request->quantity;

    //     try {
    //         $kemasan->save();
    //     } catch (\Exception $e) {
    //         session()->flash('error', 'Gagal');
    //     }

    //     try {
    //         $production->save();
    //     } catch (\Exception $e) {
    //         session()->flash('error', 'Gagal');
    //         return redirect('formula')
    //             ->with('error', 'Failed to save formula: ' . $e->getMessage());
    //     }

    //     $formula = ProductFormula::where('FAI_code', $request->FAI_code)->first();

    //     if ($formula) {
    //         $FAI_code_barang_array = json_decode($formula->FAI_code_barang, true);
    //         $persentase_array = json_decode($formula->persentase, true);

    //         if (is_array($FAI_code_barang_array) && is_array($persentase_array)) {
    //             foreach ($FAI_code_barang_array as $index => $FAI_code_barang) {
    //                 $requestedWeight = $request->quantity;
    //                 $percentage = floatval($persentase_array[$index]);

    //                 $hasilPersen = $requestedWeight * ($percentage / 100);

    //                 $avaible = Stock::where('FAI_code', $FAI_code_barang)->sum('quantity');
    //             }
    //         }
    //     }

    //     if ($hasilPersen > $avaible) {
    //         return redirect('formula')->with('warning', 'Partial stock issued. Requested quantity exceeds available stock.');
    //         session()->flash('error', 'Gagal');
    //     } else {
    //         try {
    //             $this->decreaseStock($request);
    //         } catch (\Exception $e) {
    //             return redirect('formula')
    //                 ->with('error', 'Gagal bro');
    //         }
    //         session()->flash('success', 'Berhasil');
    //         return redirect('production/form')->with('success', 'Stock issued successfully.');
    //     }
    // }

    // private function decreaseStock($request)
    // {
    //     $formula = ProductFormula::where('FAI_code', $request->FAI_code)->first();

    //     if ($formula) {
    //         $FAI_code_barang_array = json_decode($formula->FAI_code_barang, true);
    //         $persentase_array = json_decode($formula->persentase, true);

    //         if (is_array($FAI_code_barang_array) && is_array($persentase_array)) {
    //             foreach ($FAI_code_barang_array as $index => $FAI_code_barang) {
    //                 $requestedWeight = $request->quantity;
    //                 $percentage = floatval($persentase_array[$index]);

    //                 $hasilPersen = $requestedWeight * ($percentage / 100);

    //                 $stl = Stock::where('FAI_code', $FAI_code_barang)->value('id_rak');
    //                 $rakGudang = RakGudang::where('id_rak', $stl)->first();

    //                 if ($rakGudang) {
    //                     $rakGudang->kapasitas += $hasilPersen;
    //                     $rakGudang->save();
    //                 }

    //                 // Kurangi stok lot sesuai persentase
    //                 $lotStocks = Stock::where('FAI_code', $FAI_code_barang)->get();

    //                 foreach ($lotStocks as $lotStock) {
    //                     // Periksa apakah stok cukup untuk dikurangi
    //                     if ($lotStock->quantity >= $hasilPersen) {
    //                         $lotStock->quantity -= $hasilPersen;
    //                         $lotStock->save();
    //                         break; // Keluar dari loop setelah stok dikurangi
    //                     } else {
    //                         $hasilPersen -= $lotStock->quantity;
    //                         $lotStock->quantity = 0;
    //                         $lotStock->save();
    //                     }
    //                 }                    
    //             }
    //         }
    //     }
    // }






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

        return true; // Kembalikan true jika stok mencukupi
    }

    // public function storeProduction(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'FAI_code' => 'required',
    //         'product_name' => 'required',
    //         'id_rak' => 'required',
    //         'quantity' => 'required',
    //         'unit' => 'required',
    //         'tanggal_produksi' => 'required',
    //         'tanggal_expire' => 'required',
    //         'no_LOT' => 'required',
    //         'jumlah_kemasan' => 'required',
    //         'jenis_kemasan' => 'required',
    //         'customer_name' => 'required',
    //         'customer_code' => 'required',
    //         'no_production' => 'required',
    //         'no_work_order' => 'required',
    //         'PO_customer' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect('formula')
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     // if (!$this->stockGudang($request)) {
    //     //     return redirect('formula')
    //     //         ->with('error', 'Stock tak ada mas');
    //     // }

    //     $production = new Stock([
    //         'FAI_code' => $request->FAI_code,
    //         'no_LOT' => $request->no_LOT,
    //         'quantity' => $request->quantity,
    //         'unit' => $request->unit,
    //         'tanggal_produksi' => $request->tanggal_produksi,
    //         'tanggal_expire' => $request->tanggal_expire,
    //         'id_rak' => $request->id_rak,
    //         'jumlah_kemasan' => $request->jumlah_kemasan,
    //         'jenis_kemasan' => $request->jenis_kemasan,
    //         'no_production' => $request->no_production,
    //         'no_work_order' => $request->no_work_order,
    //     ]);

    //     session(['FAI_code' => $request->input('FAI_code')]);
    //     session(['product_name' => $request->input('product_name')]);
    //     session(['no_LOT' => $request->input('no_LOT')]);
    //     session(['quantity' => $request->input('quantity')]);
    //     session(['unit' => $request->input('unit')]);
    //     session(['tanggal_produksi' => $request->input('tanggal_produksi')]);
    //     session(['tanggal_expire' => $request->input('tanggal_expire')]);
    //     session(['id_rak' => $request->input('id_rak')]);
    //     session(['jumlah_kemasan' => $request->input('jumlah_kemasan')]);
    //     session(['jenis_kemasan' => $request->input('jenis_kemasan')]);
    //     session(['no_production' => $request->input('no_production')]);
    //     session(['no_work_order' => $request->input('no_work_order')]);
    //     session(['customer_name' => $request->input('customer_name')]);
    //     session(['customer_code' => $request->input('customer_code')]);
    //     session(['PO_customer' => $request->input('PO_customer')]);



    //     $rakGudang = RakGudang::where('id_rak', $request->id_rak)->first();

    //     if (!$rakGudang) {
    //         session()->flash('error', 'Gagal');

    //         return redirect('formula')->with('error', 'Rak Gudang not found for the specified FAI_code.');
    //     }
    //     $rakGudang->kapasitas -= $request->quantity;

    //     try {
    //         $rakGudang->save();
    //     } catch (\Exception $e) {
    //         session()->flash('error', 'Gagal');
    //     }

    //     $cust = CustList::where('customer_name', $request->customer_name && 'customer_code', $request->customer_code)->first();
    //     $custID = Customer::where('customer_name', $request->customer_name)->value('id_customer');

    //     if ($cust) {
    //         $cust->update([
    //             'customer_name' => $request->customer_name,
    //         ]);
    //     } elseif (!$cust) {
    //         $custList = new CustList([
    //             'customer_name' => $request->customer_name,
    //             'customer_code' => $request->customer_code,
    //             'FAI_code' => $request->FAI_code,
    //             'PO_customer' => $request->PO_customer,
    //             'id_customer' => $custID,
    //         ]);

    //         try {
    //             $custList->save();
    //         } catch (\Exception $e) {
    //             return redirect()->back()->with('error');
    //         }
    //     } else {
    //         session()->flash('error', 'Kapasitas Rak tidak mencukupi');
    //         return redirect('formula');
    //     }

    //     $kemasan = Packaging::where('nama_kemasan', $request->jenis_kemasan)->first();
    //     if (!$kemasan) {
    //         session()->flash('error', 'mau pake apa?');
    //         return redirect('formula')->with('error', 'Mau diwadahin apaan?');
    //     }

    //     $kemasan->quantity -= $request->quantity;

    //     try {
    //         $kemasan->save();
    //     } catch (\Exception $e) {
    //         session()->flash('error', 'Gagal');
    //     }

    //     try {
    //         $production->save();
    //     } catch (\Exception $e) {
    //         session()->flash('error', 'Gagal');
    //         return redirect('formula')
    //             ->with('error', 'Failed to save formula: ' . $e->getMessage());
    //     }

    //     // $formula = ProductFormula::where('FAI_code', $request->FAI_code)->first();

    //     // if ($formula) {
    //     //     $FAI_code_barang_array = json_decode($formula->FAI_code_barang, true);
    //     //     $persentase_array = json_decode($formula->persentase, true);

    //     //     if (is_array($FAI_code_barang_array) && is_array($persentase_array)) {
    //     //         foreach ($FAI_code_barang_array as $index => $FAI_code_barang) {
    //     //             $requestedWeight = $request->quantity;
    //     //             $percentage = floatval($persentase_array[$index]);

    //     //             $hasilPersen = $requestedWeight * ($percentage / 100);

    //     //             $avaible = Stock::where('FAI_code', $FAI_code_barang)->sum('quantity');
    //     //         }
    //     //     }
    //     // }

    //     // if ($hasilPersen > $avaible) {
    //     //     return redirect('formula')->with('warning', 'Partial stock issued. Requested quantity exceeds available stock.');
    //     //     session()->flash('error', 'Gagal');
    //     // } else {
    //     //     try {
    //     //         $this->decreaseStock($request);
    //     //     } catch (\Exception $e) {
    //     //         return redirect('formula')
    //     //             ->with('error', 'Gagal bro');
    //     //     }
    //     session()->flash('success', 'Berhasil');
    //     return redirect('production/form')->with('success', 'Stock issued successfully.');
    // }


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

        // Create a new Stock instance
        $production = new Stock([
            'FAI_code' => $request->FAI_code,
            'no_LOT' => $request->no_LOT,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'tanggal_produksi' => $request->tanggal_produksi,
            'tanggal_expire' => $request->tanggal_expire,
            'id_rak' => $request->id_rak,
            'jumlah_kemasan' => $request->jumlah_kemasan,
            'jenis_kemasan' => $request->jenis_kemasan,
            'no_production' => $request->no_production,
            'no_work_order' => $request->no_work_order,
        ]);

        try {
            // Save the production data
            $production->save();

            // Deduct quantity from the rack
            $rakGudang = RakGudang::where('id_rak', $request->id_rak)->firstOrFail();
            $rakGudang->kapasitas -= $request->quantity;
            $rakGudang->save();

            // Check and update customer details
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

            // Update packaging quantity
            $kemasan = Packaging::where('nama_kemasan', $request->jenis_kemasan)->firstOrFail();
            $kemasan->quantity -= $request->quantity;
            $kemasan->save();

            session()->flash('success', 'Berhasil');
            return redirect('production/form')->with('success', 'Stock issued successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal: ' . $e->getMessage());
            return redirect('formula')->with('error', 'Gagal: ' . $e->getMessage());
        }
    }



    // private function decreaseStock($request)
    // {
    //     $formula = ProductFormula::where('FAI_code', $request->FAI_code)->first();

    //     if ($formula) {
    //         $FAI_code_barang_array = json_decode($formula->FAI_code_barang, true);
    //         $persentase_array = json_decode($formula->persentase, true);

    //         if (is_array($FAI_code_barang_array) && is_array($persentase_array)) {
    //             foreach ($FAI_code_barang_array as $index => $FAI_code_barang) {
    //                 $requestedWeight = $request->quantity;
    //                 $percentage = floatval($persentase_array[$index]);

    //                 $hasilPersen = $requestedWeight * ($percentage / 100);

    //                 $stl = Stock::where('FAI_code', $FAI_code_barang)->value('id_rak');
    //                 $rakGudang = RakGudang::where('id_rak', $stl)->first();

    //                 if ($rakGudang) {
    //                     $rakGudang->kapasitas += $hasilPersen;
    //                     $rakGudang->save();
    //                 }

    //                 // Kurangi stok lot sesuai persentase
    //                 $lotStocks = Stock::where('FAI_code', $FAI_code_barang)->get();

    //                 foreach ($lotStocks as $lotStock) {
    //                     // Periksa apakah stok cukup untuk dikurangi
    //                     if ($lotStock->quantity >= $hasilPersen) {
    //                         $lotStock->quantity -= $hasilPersen;
    //                         $lotStock->save();
    //                         break; // Keluar dari loop setelah stok dikurangi
    //                     } else {
    //                         $hasilPersen -= $lotStock->quantity;
    //                         $lotStock->quantity = 0;
    //                         $lotStock->save();
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }








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
        try {
            $dataArray = $request->input('FAI_code_barang');
            $persentase_array = $request->input('persentase_array');
            $requestedWeight = $request->quantity;

            foreach ($dataArray as $index => $FAI_code_barang) {
                $percentage = floatval($persentase_array[$index]);
                $hasilPersen = $requestedWeight * ($percentage / 100);

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
            session()->flash('success', 'Berhasil');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal: ' . $e->getMessage());
        }

        return redirect('formula');
    }
}
