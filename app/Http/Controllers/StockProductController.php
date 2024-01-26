<?php

namespace App\Http\Controllers;

use App\Models\ProductFormula;
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
        // Validate the input data
        $request->validate([
            'FAI_code' => 'required',
            'product_name' => 'required',
            'storage' => 'required',
            'weight' => 'required',
            'unit' => 'required',
        ]);
    
        // Check if the FAI_code already exists in the StockProduct table
        $existingProduct = StockProduct::where('FAI_code', $request->FAI_code)->first();
    
        if ($existingProduct) {
            // If the product already exists, update its weight
            $existingProduct->weight += $request->weight;
            $existingProduct->save();
        } else {
            // If the product does not exist, create a new entry
            $production = new StockProduct([
                'FAI_code' => $request->FAI_code,
                'FINA_code' => $request->FAI_code, // Assuming FINA_code is derived from FAI_code
                'product_name' => $request->product_name,
                'storage' => $request->storage,
                'weight' => $request->weight,
                'unit' => $request->unit,
            ]);
    
            // Save the production entry
            $production->save();
        }
        // Get the product formula for the given FAI_code
        $formula = ProductFormula::where('FAI_code', $request->FAI_code)->first();

        // Check if the formula exists
        if ($formula) {
            // Decode the JSON-encoded persentase values
            // Update stock weights for stock_product
            $this->updateStockProductWeight($request->FAI_code, $request->weight);
        }

        // Redirect or return a response as needed
        return redirect('formula')->with('success', 'Production entry saved successfully.');
    }

    private function updateStockProductWeight($FAI_code, $originalWeight)
    {
        // Get the product formula for the given FAI_code
        $formula = ProductFormula::where('FAI_code', $FAI_code)->first();

        // Check if the formula exists
        if ($formula) {
            // Confirm that FAI_code_barang and persentase are arrays
            $FAI_code_barang_array = json_decode($formula->FAI_code_barang, true);
            $persentase_array = json_decode($formula->persentase, true);

            if (is_array($FAI_code_barang_array) && is_array($persentase_array)) {
                // Calculate the new weights based on percentages for each FAI_code_barang
                foreach ($FAI_code_barang_array as $index => $FAI_code_barang) {
                    // Ensure that $originalWeight and $percentage are numeric values
                    $originalWeight = floatval($originalWeight);
                    $percentage = floatval($persentase_array[$index]);

                    // Get the stock product for the given FAI_code_barang
                    $stockBarang = StockBarang::where('FAI_code', $FAI_code_barang)->first();
                    $stockProduct = stockProduct::where('FAI_code', $FAI_code_barang)->first();
                    // Check if the stock product exists
                    if ($stockBarang) {
                        // Calculate the new weight based on the percentage
                        $newWeight = $originalWeight * ($percentage / 100);

                        // Update the stock product quantity
                        $stockBarang->quantity -= $newWeight;
                        $stockBarang->save();
                    }
                    if ($stockProduct) {
                        $newWeight = $originalWeight * ($percentage / 100);

                        // Update the stock product quantity
                        $stockProduct->weight -= $newWeight;
                        $stockProduct->save();
                    }
                }
            }
        }
    }
}
