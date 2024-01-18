<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\ProductFormula;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function dataProduct()
    {
        $prd = Products::all();
        return view('product.data', ['prd' => $prd]);
    }

    public function newProductForm()
    {
        $brg = Barang::all();
        return view('product.inputProduct', ['brg' => $brg]);
    }

    public function newProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'FAI_code' => 'required',
            'category' => 'required',
            'aspect' => 'required',
            'FINA_code' => 'required',
            'product_name' => 'required',
            'build_product' => 'required',
            'formula_id' => 'required',
            'segment' => 'required',
            'solubility' => 'required',
            'created_date' => 'required',
            'release_date' => 'required',
            'created_by' => 'required',
            'note' => 'required',
            'storage' => 'required',
            'total_order' => 'required',
            'unit' => 'required',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Combine selected documentation checkboxes into a string

        // Create a new BarangMasuk instance and fill it with the request data
        $Products = new Products([
            'FAI_code' => $request->FAI_code,
            'category' => $request->category,
            'aspect' => $request->aspect,
            'FINA_code' => $request->FINA_code,
            'product_name' => $request->product_name,
            'build_product' => $request->build_product,
            'formula_id' => $request->formula_id,
            'segment' => $request->segment,
            'solubility' => $request->solubility,
            'created_date' => $request->created_date,
            'release_date' => $request->release_date,
            'created_by' => $request->created_by,
            'note' => $request->note,
            'storage' => $request->storage,
            'total_order' => $request->total_order,
            'unit' => $request->unit,
        ]);

        // Step 2: Save the Products instance to insert data into the barang_masuk table
        try {
            $Products->save();
        } catch (\Exception $e) {
            // Log or dd($e->getMessage()) to see the exception details
            dd($e->getMessage());
        }

        // Create a new Stock instance and fill it with the request data
        $formula = new ProductFormula([
            'FAI_code' => $request->FAI_code,
            'product_name' => $request->product_name,
            'FAI_code_barang' => $request->FAI_code_barang,
            'persentase' => $request->persentase,
        ]);

        // Step 3: Save the formula instance to insert data into the formula_lot table
        try {
            $formula->save();
        } catch (\Exception $e) {
            // Log or dd($e->getMessage()) to see the exception details
            dd($e->getMessage());
        }

        // Step 4: Redirect after saving
        return redirect('Products');
    }
}
