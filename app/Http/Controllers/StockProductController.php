<?php

namespace App\Http\Controllers;

use App\Models\ProductFormula;
use App\Models\RakGudang;
use App\Models\StockBarang;
use App\Models\stockProduct;
use Illuminate\Http\Request;

class StockProductController extends Controller
{

    public function stock()
    {
        $stock = stockProduct::all();
        return view('stock.stockProduct', ['stock' => $stock]);
    }


    public function storeProduction(Request $request)
    {
        $request->validate([
            'FAI_code' => 'required',
            'product_name' => 'required',
            'storage' => 'required',
            'weight' => 'required',
            'unit' => 'required',
        ]);

        $existingProduct = StockProduct::where('FAI_code', $request->FAI_code)->first();

        if ($existingProduct) {
            $existingProduct->weight += $request->weight;
            $existingProduct->save();
        } else {
            $production = new StockProduct([
                'FAI_code' => $request->FAI_code,
                'FINA_code' => $request->FAI_code, // Assuming FINA_code is derived from FAI_code
                'product_name' => $request->product_name,
                'storage' => $request->storage,
                'weight' => $request->weight,
                'unit' => $request->unit,
            ]);

            $production->save();

            $rakGudang = RakGudang::where('id_rak', $request->storage)->first();
            if ($rakGudang) {
                $rakGudang->kapasitas -= $request->weight;
                $rakGudang->save();
            }
        }
        $formula = ProductFormula::where('FAI_code', $request->FAI_code)->first();

        if ($formula) {
            $this->updateStockProductWeight($request->FAI_code, $request->weight);
        }

        return redirect('formula')->with('success', 'Production entry saved successfully.');
    }

    private function updateStockProductWeight($FAI_code, $originalWeight)
    {
        $formula = ProductFormula::where('FAI_code', $FAI_code)->first();

        if ($formula) {
            $FAI_code_barang_array = json_decode($formula->FAI_code_barang, true);
            $persentase_array = json_decode($formula->persentase, true);

            if (is_array($FAI_code_barang_array) && is_array($persentase_array)) {
                foreach ($FAI_code_barang_array as $index => $FAI_code_barang) {
                    $originalWeight = floatval($originalWeight);
                    $percentage = floatval($persentase_array[$index]);

                    $stockBarang = StockBarang::where('FAI_code', $FAI_code_barang)->first();
                    $stockProduct = stockProduct::where('FAI_code', $FAI_code_barang)->first();
                    $newWeight = $originalWeight * ($percentage / 100);

                    if ($stockBarang) {

                        $stockBarang->quantity -= $newWeight;
                        $stockBarang->save();
                    }
                    if ($stockProduct) {

                        $stockProduct->weight -= $newWeight;
                        $stockProduct->save();
                    }
                }
            }
        }
    }
}
