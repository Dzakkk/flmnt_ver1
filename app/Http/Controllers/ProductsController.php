<?php

namespace App\Http\Controllers;

use App\Exports\ProductionControlExport;
use App\Models\Barang;
use App\Models\CustList;
use App\Models\Customer;
use App\Models\Gudang;
use App\Models\Packaging;
use App\Models\ProductFormula;
use App\Models\ProductionControl;
use App\Models\Products;
use App\Models\RakGudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
{
    public function dataProduct()
    {
        $prd = Products::with('formula')->paginate(8);
        $frm = ProductFormula::all();
        $rak = RakGudang::all();
        $cust = Customer::all();
        $custList = CustList::all();
        $kemasan = Packaging::all();
        return view('product.data', compact('prd', 'rak', 'cust', 'custList', 'kemasan'));
    }

    public function search(Request $request)
    {
        try {
            $searchTerm = $request->input('search');

            $prd = Products::with('formula')->where('FAI_code', 'like', '%' . $searchTerm . '%')
                ->orWhere('product_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('aspect', 'like', '%' . $searchTerm . '%')
                ->orWhere('segment', 'like', '%' . $searchTerm . '%')
                ->orWhere('category', 'like', '%' . $searchTerm . '%')
                ->orWhere('formula_id', 'like', '%' . $searchTerm . '%')

                ->paginate(8);

                $frm = ProductFormula::all();
                $rak = RakGudang::all();
                $cust = Customer::all();
                $custList = CustList::all();
                $kemasan = Packaging::all();    
        
        
                
            return view('product.data', compact('prd', 'rak', 'custList', 'kemasan', 'cust'));
        } catch (\Exception $e) {
            return redirect('/product');
        }
    }

    public function formula()
    {
        $frm = ProductFormula::all();
        $rak = RakGudang::all();
        $cust = Customer::all();
        $custList = CustList::all();
        $kemasan = Packaging::all();
        return view('product.formula', ['frm' => $frm, 'rak' => $rak, 'cust' => $cust, 'customerCodes' => $custList, 'kemasan' => $kemasan]);
    }

    public function updateProductForm($id)
{
    $prd = Products::find($id);
    $brg = Barang::all();
    $gdg = Gudang::all();

    // Ambil nilai persentase dan FAI_code dari entitas ProductFormula
    $productFormula = ProductFormula::find($id);
    $persentase = json_decode($productFormula->persentase, true);
    $FAI_code = json_decode($productFormula->FAI_code_barang, true);

    return view('product.update', compact('prd', 'brg', 'gdg', 'persentase', 'FAI_code'));
}

    public function newProductForm()
    {
        $brg = Barang::all();
        $gdg = Gudang::all();
        $prd = Products::all();
        return view('product.inputProduct', ['brg' => $brg, 'gdg' => $gdg, 'prd' => $prd]);
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
            'target_order' => 'required',
            'unit' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
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
            'target_order' => $request->target_order,
            'unit' => $request->unit,

            'range_color' => $request->range_color,
            'odour_taste' => $request->odour_taste,
        

            'sg_d20_min' => $request->sg_d20_min,
            'sg_d20_max' => $request->sg_d20_max,
            'sg_d20_target' => $request->sg_d20_target,

            'sg_d25_min' => $request->sg_d25_min,
            'sg_d25_max' => $request->sg_d25_max,
            'sg_d25_target' => $request->sg_d25_target,

            'ri_d20_min' => $request->ri_d20_min,
            'ri_d20_max' => $request->ri_d20_max,
            'ri_d20_target' => $request->ri_d20_target,

            'ri_d25_min' => $request->ri_d25_min,
            'ri_d25_max' => $request->ri_d25_max,
            'ri_d25_target' => $request->ri_d25_target,
        ]);

        try {
            $Products->save();
            // dd($Products);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $formula = new ProductFormula([
            'FAI_code' => $request->FAI_code,
            'product_name' => $request->product_name,
            'FAI_code_barang' => json_encode($request->FAI_code_barang),
            'persentase' => json_encode($request->persentase, JSON_NUMERIC_CHECK),
        ]);

        try {
            $formula->save();
            // dd($formula);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return redirect('product');
    }





    public function updateProduct(Request $request, $id)
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
            'target_order' => 'required',
            'storage' => 'required',
            'unit' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = Products::findOrFail($id);
        $product->update([
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
            'target_order' => $request->target_order,
            'unit' => $request->unit,

            'range_color' => $request->range_color,
            'odour_taste' => $request->odour_taste,
        

            'sg_d20_min' => $request->sg_d20_min,
            'sg_d20_max' => $request->sg_d20_max,
            'sg_d20_target' => $request->sg_d20_target,

            'sg_d25_min' => $request->sg_d25_min,
            'sg_d25_max' => $request->sg_d25_max,
            'sg_d25_target' => $request->sg_d25_target,

            'ri_d20_min' => $request->ri_d20_min,
            'ri_d20_max' => $request->ri_d20_max,
            'ri_d20_target' => $request->ri_d20_target,

            'ri_d25_min' => $request->ri_d25_min,
            'ri_d25_max' => $request->ri_d25_max,
            'ri_d25_target' => $request->ri_d25_target,
        ]);

        $formula = ProductFormula::where('FAI_code', $id)->first();

    if ($formula) {
        $formula->update([
            'FAI_code' => $request->FAI_code,
            'product_name' => $request->product_name,
            'FAI_code_barang' => json_encode($request->FAI_code_barang),
            'persentase' => json_encode($request->persentase, JSON_NUMERIC_CHECK),
        ]);
    }

        return redirect('product');
    }

    public function dataProduction()
    {
        $prd = ProductionControl::all();
        return view('production.ProductionData', ['prd' => $prd]);
    }


    public function exportProductionControl()
    {
        return Excel::download(new ProductionControlExport, 'ProductionControl.xlsx');
    }

}
