<?php

namespace App\Http\Controllers;

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

    //ini asli

    // public function storeProduction(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $request->validate([
    //             'FAI_code' => 'required',
    //             'product_name' => 'required',
    //             'id_rak' => 'required',
    //             'quantity' => 'required',
    //             'unit' => 'required',
    //             'tanggal_produksi' => 'required',
    //             'tanggal_expire' => 'required',
    //             'no_LOT' => 'required',
    //         ]);

    //         $rakGudang = RakGudang::where('id_rak', $request->id_rak)->firstOrFail();
    //         $rakGudang->kapasitas -= $request->quantity;
    //         $rakGudang->save();

    //         // Membuat data baru di stock_lot
    //         $stockLot = new Stock([
    //             'FAI_code' => $request->FAI_code,
    //             'no_LOT' => $request->no_LOT,
    //             'quantity' => $request->quantity,
    //             'unit' => $request->unit,
    //             'tanggal_produksi' => $request->tanggal_produksi,
    //             'tanggal_expire' => $request->tanggal_expire,
    //             'id_rak' => $request->id_rak,
    //         ]);
    //         $stockLot->save();

    //         $PructAspect = Products::where('FAI_code', $request->FAI_code)->value('aspect');
    //         $Common = Products::where('FAI_code', $request->FAI_code)->value('created_by');
    //         $ctrg = Products::where('FAI_code', $request->FAI_code)->value('category');

    //         // Membuat data baru di stock_product jika belum ada
    //         $existingProduct = StockProduct::where('FAI_code', $request->FAI_code)->first();
    //         if (!$existingProduct) {
    //             $production = new StockProduct([
    //                 'FAI_code' => $request->FAI_code,
    //                 'FINA_code' => $request->FAI_code,
    //                 'product_name' => $request->product_name,
    //                 'common_name' => $Common,
    //                 'aspect' => $PructAspect,
    //                 'category' => $ctrg,
    //                 'unit' => $request->unit,

    //             ]);
    //             $this->updateStockProductWeight($request->FAI_code, $request->quantity);

    //             $this->increaseRakCapacity($request->FAI_code, $request->quantity);    

    //             $production->save();
    //         }

    //         // Mengurangi setiap barang atau produk yang digunakan di fungsi tersebut (FAI_code_barang)
    //         DB::commit();
    //         return redirect('formula')->with('success', 'Production entry saved successfully.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect('formula')->with('error', 'Failed to save production entry: ' . $e->getMessage());
    //     }
    // }

    // private function updateStockProductWeight($FAI_code, $originalQuantity)
    // {
    //     $formula = ProductFormula::where('FAI_code', $FAI_code)->first();

    //     if ($formula) {
    //         $FAI_code_barang_array = json_decode($formula->FAI_code_barang, true);
    //         $persentase_array = json_decode($formula->persentase, true);

    //         if (is_array($FAI_code_barang_array) && is_array($persentase_array)) {
    //             foreach ($FAI_code_barang_array as $index => $FAI_code_barang) {
    //                 $originalQuantity = floatval($originalQuantity);
    //                 $percentage = floatval($persentase_array[$index]);

    //                 $newQuantity = $originalQuantity * ($percentage / 100);

    //                 while ($newQuantity > 0) {
    //                     $stockBarang = Stock::where('FAI_code', $FAI_code_barang)
    //                         ->where('quantity', '>', 0)
    //                         ->first();

    //                     if ($stockBarang) {
    //                         $quantityToUse = min($newQuantity, $stockBarang->quantity);
    //                         $newQuantity -= $quantityToUse;
    //                         $stockBarang->quantity -= $quantityToUse;
    //                         $stockBarang->save();
    //                     } else {
    //                         // Cari stok untuk FAI_code yang lain
    //                         $otherStockBarang = Stock::where('FAI_code', '!=', $FAI_code)
    //                             ->where('quantity', '>', 0)
    //                             ->first();

    //                         if ($otherStockBarang) {
    //                             $quantityToUse = min($newQuantity, $otherStockBarang->quantity);
    //                             $newQuantity -= $quantityToUse;
    //                             $otherStockBarang->quantity -= $quantityToUse;
    //                             $otherStockBarang->save();
    //                         } else {
    //                             // Jika tidak ada stok yang cukup
    //                            break;
    //                         }
    //                     }
    //                     if ($newQuantity > 0) {
    //                         throw new \Exception('Insufficient quantity for FAI_code: ' . $FAI_code_barang);
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }



    // private function increaseRakCapacity($FAI_code, $quantity)
    // {
    //     $formula = ProductFormula::where('FAI_code', $FAI_code)->first();

    //     if ($formula) {
    //         $FAI_code_barang_array = json_decode($formula->FAI_code_barang, true);
    //         $persentase_array = json_decode($formula->persentase, true);

    //         if (is_array($FAI_code_barang_array) && is_array($persentase_array)) {
    //             foreach ($FAI_code_barang_array as $index => $FAI_code_barang) {
    //                 $percentage = floatval($persentase_array[$index]);
    //                 $newQuantity = $quantity * ($percentage / 100);

    //                 $stl = Stock::where('FAI_code', $FAI_code_barang)->value('id_rak');

    //                 $rakGudang = RakGudang::where('id_rak', $stl)->first();
    //                 if ($rakGudang) {
    //                     $rakGudang->kapasitas += $newQuantity;
    //                     $rakGudang->save();
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
            'jumlah_kemasan' => 'required',
            'jenis_kemasan' => 'required',
            'PO_customer' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('formula')
                ->withErrors($validator)
                ->withInput();
        }

        if (!$this->stockGudang($request)) {
            return redirect('formula')
                ->with('error', 'Stock tak ada mas');
        }

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

        $rakGudang = RakGudang::where('id_rak', $request->id_rak)->first();

        if (!$rakGudang) {
            session()->flash('error', 'Gagal');

            return redirect('formula')->with('error', 'Rak Gudang not found for the specified FAI_code.');
        }
        $rakGudang->kapasitas -= $request->quantity;

        try {
            $rakGudang->save();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal');
        }
        
        $kemasan = Packaging::where('nama_kemasan', $request->jenis_kemasan)->first();
        if (!$kemasan) {
            session()->flash('error', 'mau pake apa?');
            return redirect('formula')->with('error', 'Mau diwadahin apaan?');
        }

        $kemasan->quantity -= $request->quantity;

        try {
            $kemasan->save();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal');
        }

        try {
            $production->save();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal');
            return redirect('formula')
                ->with('error', 'Failed to save formula: ' . $e->getMessage());
        }

        $formula = ProductFormula::where('FAI_code', $request->FAI_code)->first();

        if ($formula) {
            $FAI_code_barang_array = json_decode($formula->FAI_code_barang, true);
            $persentase_array = json_decode($formula->persentase, true);

            if (is_array($FAI_code_barang_array) && is_array($persentase_array)) {
                foreach ($FAI_code_barang_array as $index => $FAI_code_barang) {
                    $requestedWeight = $request->quantity;
                    $percentage = floatval($persentase_array[$index]);

                    $hasilPersen = $requestedWeight * ($percentage / 100);

                    $avaible = Stock::where('FAI_code', $FAI_code_barang)->sum('quantity');
                }
            }
        }

        if ($hasilPersen > $avaible) {
            // If requested quantity is more than available stock
            return redirect('formula')->with('warning', 'Partial stock issued. Requested quantity exceeds available stock.');
            session()->flash('error', 'Gagal');
        } else {
            try {
                $this->decreaseStock($request);
            } catch (\Exception $e) {
                return redirect('formula')
                    ->with('error', 'Gagal bro');
            }
            session()->flash('success', 'Berhasil');
            return redirect('formula')->with('success', 'Stock issued successfully.');
        }
    }

    private function decreaseStock($request)
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

                    $stl = Stock::where('FAI_code', $FAI_code_barang)->value('id_rak');
                    $rakGudang = RakGudang::where('id_rak', $stl)->first();

                    if ($rakGudang) {
                        $rakGudang->kapasitas += $hasilPersen;
                        $rakGudang->save();
                    }

                    // Kurangi stok lot sesuai persentase
                    $lotStocks = Stock::where('FAI_code', $FAI_code_barang)->get();

                    foreach ($lotStocks as $lotStock) {
                        // Periksa apakah stok cukup untuk dikurangi
                        if ($lotStock->quantity >= $hasilPersen) {
                            $lotStock->quantity -= $hasilPersen;
                            $lotStock->save();
                            break; // Keluar dari loop setelah stok dikurangi
                        } else {
                            $hasilPersen -= $lotStock->quantity;
                            $lotStock->quantity = 0;
                            $lotStock->save();
                        }
                    }                    
                }
            }
        }
    }

    public function getRakOptions(Request $request)
    {
        $FAI_code = $request->FAI_code;

        // Retrieve Rak options based on the FAI_code from the Barang Masuk table
        $rakOptions = DB::table('stock_lot')
            ->join('rak_gudang', 'stock_lot.id_rak', '=', 'rak_gudang.id_rak')
            ->where('stock_lot.FAI_code', $FAI_code)
            ->select('rak_gudang.id_rak')
            ->distinct()
            ->get();

        return response()->json(['options' => $rakOptions]);
    }
}
