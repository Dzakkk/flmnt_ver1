<?php

namespace App\Http\Controllers;

use App\Models\ProductFormula;
use App\Models\Stock;
use App\Models\stockProduct;
use Illuminate\Http\Request;

class StockProductController extends Controller
{
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

        // Create a new production entry
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

        // Get the product formula for the given FAI_code
        $formula = ProductFormula::where('FAI_code', $request->FAI_code)->first();

        // Check if the formula exists
        if ($formula) {
            // Decode the JSON-encoded persentase values
            $persentase = json_decode($formula->persentase, true);

            // Update stock weights for stock_product
            $this->updateStockProductWeight($request->FAI_code, $persentase, $request->weight);
        }

        // Redirect or return a response as needed
        return redirect('formula')->with('success', 'Production entry saved successfully.');
    }

    private function updateStockProductWeight($FAI_code, $persentase, $originalWeight)
    {
        // Get the stock product for the given FAI_code
        $stockProduct = StockProduct::where('FAI_code', $FAI_code)->first();

        // Check if the stock product exists
        if ($stockProduct) {
            // Calculate the new weights based on percentages
            $newWeights = [];
            foreach ($persentase as $percentage) {
                $newWeights[] = $originalWeight * ($percentage / 100);
            }

            // Update the stock product weights
            $stockProduct->update([
                'weight' => $originalWeight - array_sum($newWeights),
            ]);
        }
    }
}


