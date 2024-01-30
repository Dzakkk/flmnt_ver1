<?php

namespace App\Http\Controllers;

use App\Models\ProductFormula;
use App\Models\Products;
use App\Models\RakGudang;
use App\Models\Stock;
use App\Models\StockBarang;
use App\Models\stockProduct;
use Illuminate\Http\Request;

class StockProductController extends Controller
{

    public function stock()
    {
        // $stock = stockProduct::all();
        $stock = stockProduct::with('stockLot', 'product')->get();
        return view('stock.stockProduct', ['stock' => $stock]);
    }


    // public function storeProduction(Request $request)
    // {
    //     $request->validate([
    //         'FAI_code' => 'required',
    //         'product_name' => 'required',
    //         'id_rak' => 'required',
    //         'quantity' => 'required',
    //         'unit' => 'required',
    //         'tanggal_produksi' => 'required',
    //         'tanggal_expire' => 'required',
    //         'no_LOT' => 'required',
    //     ]);

    //     $existingProduct = StockProduct::where('FAI_code', $request->FAI_code)->first();

    //     if ($existingProduct) {
    //         $existingProduct->weight += $request->weight;
    //         $existingProduct->save();
    //     } else {
    //         $production = new StockProduct([
    //             'FAI_code' => $request->FAI_code,
    //             'FINA_code' => $request->FAI_code, // Assuming FINA_code is derived from FAI_code
    //             'product_name' => $request->product_name,
    //             'storage' => $request->storage,
    //             'quantity' => $request->quantity,
    //             'unit' => $request->unit,
    //             'tanggal_produksi' => $request->tanggal_produksi,
    //             'tanggal_expire' => $request->tanggal_expire,
    //             'no_LOT' => $request->no_LOT,
    //         ]);

    //         $production->save();

    //         $rakGudang = RakGudang::where('id_rak', $request->storage)->first();
    //         if ($rakGudang) {
    //             $rakGudang->kapasitas -= $request->weight;
    //             $rakGudang->save();
    //         }
    //     }
    //     $formula = ProductFormula::where('FAI_code', $request->FAI_code)->first();

    //     if ($formula) {
    //         $this->updateStockProductWeight($request->FAI_code, $request->weight);
    //     }

    //     return redirect('formula')->with('success', 'Production entry saved successfully.');
    // }

    // private function updateStockProductWeight($FAI_code, $originalWeight)
    // {
    //     $formula = ProductFormula::where('FAI_code', $FAI_code)->first();

    //     if ($formula) {
    //         $FAI_code_barang_array = json_decode($formula->FAI_code_barang, true);
    //         $persentase_array = json_decode($formula->persentase, true);

    //         if (is_array($FAI_code_barang_array) && is_array($persentase_array)) {
    //             foreach ($FAI_code_barang_array as $index => $FAI_code_barang) {
    //                 $originalWeight = floatval($originalWeight);
    //                 $percentage = floatval($persentase_array[$index]);

    //                 $stockBarang = StockBarang::where('FAI_code', $FAI_code_barang)->first();
    //                 $stockProduct = stockProduct::where('FAI_code', $FAI_code_barang)->first();
    //                 $newWeight = $originalWeight * ($percentage / 100);

    //                 if ($stockBarang) {

    //                     $stockBarang->quantity -= $newWeight;
    //                     $stockBarang->save();
    //                 }
    //                 if ($stockProduct) {

    //                     $stockProduct->weight -= $newWeight;
    //                     $stockProduct->save();
    //                 }
    //             }
    //         }
    //     }








    public function storeProduction(Request $request)
    {
        try {
            $request->validate([
                'FAI_code' => 'required',
                'product_name' => 'required',
                'id_rak' => 'required',
                'quantity' => 'required',
                'unit' => 'required',
                'tanggal_produksi' => 'required',
                'tanggal_expire' => 'required',
                'no_LOT' => 'required',
            ]);

            // Mengurangi kapasitas rak sesuai ID yang diinput
            $rakGudang = RakGudang::where('id_rak', $request->id_rak)->firstOrFail();
            $rakGudang->kapasitas -= $request->quantity; // Mengurangi kapasitas berdasarkan jumlah barang yang diproduksi
            $rakGudang->save();

            // Membuat data baru di stock_lot
            $stockLot = new Stock([
                'FAI_code' => $request->FAI_code,
                'no_LOT' => $request->no_LOT,
                'quantity' => $request->quantity,
                'unit' => $request->unit,
                'tanggal_produksi' => $request->tanggal_produksi,
                'tanggal_expire' => $request->tanggal_expire,
                'id_rak' => $request->id_rak,
            ]);
            $stockLot->save();

            $PructAspect = Products::where('FAI_code', $request->FAI_code)->value('aspect');
            $Common = Products::where('FAI_code', $request->FAI_code)->value('created_by');
            $ctrg = Products::where('FAI_code', $request->FAI_code)->value('category');

            // Membuat data baru di stock_product jika belum ada
            $existingProduct = StockProduct::where('FAI_code', $request->FAI_code)->first();
            if (!$existingProduct) {
                $production = new StockProduct([
                    'FAI_code' => $request->FAI_code,
                    'FINA_code' => $request->FAI_code,
                    'product_name' => $request->product_name,
                    'common_name' => $Common,
                    'aspect' => $PructAspect,
                    'category' => $ctrg,
                    'unit' => $request->unit,

                ]);
                $production->save();
            }

            // Mengurangi setiap barang atau produk yang digunakan di fungsi tersebut (FAI_code_barang)
            $this->updateStockProductWeight($request->FAI_code, $request->quantity);

            // Menambah kapasitas rak sesuai FAI_code_barang yang digunakan
            $this->increaseRakCapacity($request->FAI_code, $request->quantity);

            return redirect('formula')->with('success', 'Production entry saved successfully.');
        } catch (\Exception $e) {
            return redirect('formula')->with('error', 'Failed to save production entry: ' . $e->getMessage());
        }
    }

    private function updateStockProductWeight($FAI_code, $originalQuantity)
    {
        $formula = ProductFormula::where('FAI_code', $FAI_code)->first();

        if ($formula) {
            $FAI_code_barang_array = json_decode($formula->FAI_code_barang, true);
            $persentase_array = json_decode($formula->persentase, true);

            if (is_array($FAI_code_barang_array) && is_array($persentase_array)) {
                foreach ($FAI_code_barang_array as $index => $FAI_code_barang) {
                    $originalQuantity = floatval($originalQuantity);
                    $percentage = floatval($persentase_array[$index]);

                    $newQuantity = $originalQuantity * ($percentage / 100);

                    $stockBarang = Stock::where('FAI_code', $FAI_code_barang)->first();
                    if ($stockBarang) {
                        $stockBarang->quantity -= $newQuantity;
                        $stockBarang->save();
                    }
                }
            }
        }
    }
    private function increaseRakCapacity($FAI_code, $quantity)
    {
        $formula = ProductFormula::where('FAI_code', $FAI_code)->first();

        if ($formula) {
            $FAI_code_barang_array = json_decode($formula->FAI_code_barang, true);
            $persentase_array = json_decode($formula->persentase, true);

            if (is_array($FAI_code_barang_array) && is_array($persentase_array)) {
                foreach ($FAI_code_barang_array as $index => $FAI_code_barang) {
                    $percentage = floatval($persentase_array[$index]);
                    $newQuantity = $quantity * ($percentage / 100);

                    $stl = Stock::where('FAI_code', $FAI_code_barang)->value('id_rak');

                    $rakGudang = RakGudang::where('id_rak', $stl)->first();
                    if ($rakGudang) {
                        $rakGudang->kapasitas += $newQuantity;
                        $rakGudang->save();
                    }
                }
            }
        }
    }
}
