<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Manufacturer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    public function dataBarang()
    {
        $brg = Barang::with('stock')->get();
        $supp = Supplier::all();
        $ex = Manufacturer::all();
        return view('barang.dataBarang', ['brg' => $brg, 'supp' => $supp, 'ex' => $ex]);
    }

    public function newBarangForm()
    {
        $supp = Supplier::all();
        $mnc = Manufacturer::all();
        return view('barang.newBarang', ['supp' => $supp, 'ex' => $mnc]);
    }

    public function newBarang(Request $request)
    {
        $request->validate([
            'FAI_code' => 'required',
            'FINA_code' => 'required',
            'kategori_barang' => 'required',
            'aspect' => 'required',
            'initial_code' => 'required',
            'number_code' => 'required',
            'alokasi_penyimpanan' => 'required',
            'reOrder_qty' => 'required',
            'unit' => 'required',
            'supplier' => 'required',
            'packaging_type' => 'required',
            'coa_documentation' => 'required_without_all:tds_documentation,msds_documentation',
            'tds_documentation' => 'required_without_all:coa_documentation,msds_documentation',
            'msds_documentation' => 'required_without_all:coa_documentation,tds_documentation',
            'halal_certification' => 'required',
            'name' => 'required',
            'common_name' => 'required',
            'brandProduct_code' => 'required',
            'chemical_IUPACname' => 'required',
            'CAS_number' => 'required',
            'ex_origin' => 'required',
            'initial_ex' => 'required',
            'country_of_origin' => 'required',
            'remark' => 'required',
            'usage_level' => 'required',
            'harga_ex_work_USD' => 'required',
            'harga_CIF_USD' => 'required',
            'harga_MOQ_USD' => 'required',
            'appearance' => 'required',
            'color_rangeColor' => 'required',
            'odour_taste' => 'required',
            'material' => 'required',
            'spesific_gravity_d20' => 'required',
            'spesific_gravity_d25' => 'required',
            'refractive_index_d20' => 'required',
            'refractive_index_d25' => 'required',
            'berat_gram' => 'required',
        ]);

        // Combine selected documentation checkboxes into a string
        $documentation = implode(',', $request->only(['coa_documentation', 'tds_documentation', 'msds_documentation']));

        Barang::create([
            'FAI_code' => $request->FAI_code,
            'FINA_code' => $request->FINA_code,
            'kategori_barang' => $request->kategori_barang,
            'aspect' => $request->aspect,
            'initial_code' => $request->initial_code,
            'number_code' => $request->number_code,
            'alokasi_penyimpanan' => $request->alokasi_penyimpanan,
            'reOrder_qty' => $request->reOrder_qty,
            'unit' => $request->unit,
            'supplier' => $request->supplier,
            'packaging_type' => $request->packaging_type,
            'documentation' => $documentation,
            'halal_certification' => $request->halal_certification,
            'name' => $request->name,
            'common_name' => $request->common_name,
            'brandProduct_code' => $request->brandProduct_code,
            'chemical_IUPACname' => $request->chemical_IUPACname,
            'CAS_number' => $request->CAS_number,
            'ex_origin' => $request->ex_origin,
            'initial_ex' => $request->initial_ex,
            'country_of_origin' => $request->country_of_origin,
            'remark' => $request->remark,
            'usage_level' => $request->usage_level,
            'harga_ex_work_USD' => $request->harga_ex_work_USD,
            'harga_CIF_USD' => $request->harga_CIF_USD,
            'harga_MOQ_USD' => $request->harga_MOQ_USD,
            'appearance' => $request->appearance,
            'color_rangeColor' => $request->color_rangeColor,
            'odour_taste' => $request->odour_taste,
            'material' => $request->material,
            'spesific_gravity_d20' => $request->spesific_gravity_d20,
            'spesific_gravity_d25' => $request->spesific_gravity_d25,
            'refractive_index_d20' => $request->refractive_index_d20,
            'refractive_index_d25' => $request->refractive_index_d25,
            'berat_gram' => $request->berat_gram,
        ]);
        session()->flash('success', 'Data telah Ditambahkan');
        return redirect('/barang')->with('success', 'Barang berhasil ditambahkan');
    }

    public function updateBarang(Request $request, $id)
    {
        $request->validate([
            'FAI_code' => 'required',
            'FINA_code' => 'required',
            'kategori_barang' => 'required',
            'aspect' => 'required',
            'alokasi_penyimpanan' => 'required',
            'reOrder_qty' => 'required',
            'unit' => 'required',
            'supplier' => 'required',
            'packaging_type' => 'required',
            'coa_documentation' => 'required_without_all:tds_documentation,msds_documentation',
            'tds_documentation' => 'required_without_all:coa_documentation,msds_documentation',
            'msds_documentation' => 'required_without_all:coa_documentation,tds_documentation',
            'halal_certification' => 'required',
            'name' => 'required',
            'common_name' => 'required',
            'brandProduct_code' => 'required',
            'chemical_IUPACname' => 'required',
            'CAS_number' => 'required',
            'ex_origin' => 'required',
            'initial_ex' => 'required',
            'country_of_origin' => 'required',
            'remark' => 'required',
            'usage_level' => 'required',
            'harga_ex_work_USD' => 'required',
            'harga_CIF_USD' => 'required',
            'harga_MOQ_USD' => 'required',
            'appearance' => 'required',
            'color_rangeColor' => 'required',
            'odour_taste' => 'required',
            'material' => 'required',
            'spesific_gravity_d20' => 'required',
            'spesific_gravity_d25' => 'required',
            'refractive_index_d20' => 'required',
            'refractive_index_d25' => 'required',
            'berat_gram' => 'required',
        ]);

        // Combine selected documentation checkboxes into a string
        $documentation = implode(',', $request->only(['coa_documentation', 'tds_documentation', 'msds_documentation']));

        // Find the Barang model instance
        $barang = Barang::find($id);

        // Update the fields
        $barang->update([
            'FAI_code' => $request->FAI_code,
            'FINA_code' => $request->FINA_code,
            'kategori_barang' => $request->kategori_barang,
            'aspect' => $request->aspect,
            'alokasi_penyimpanan' => $request->alokasi_penyimpanan,
            'reOrder_qty' => $request->reOrder_qty,
            'unit' => $request->unit,
            'supplier' => $request->supplier,
            'packaging_type' => $request->packaging_type,
            'documentation' => $documentation,
            'halal_certification' => $request->halal_certification,
            'name' => $request->name,
            'common_name' => $request->common_name,
            'brandProduct_code' => $request->brandProduct_code,
            'chemical_IUPACname' => $request->chemical_IUPACname,
            'CAS_number' => $request->CAS_number,
            'ex_origin' => $request->ex_origin,
            'initial_ex' => $request->initial_ex,
            'country_of_origin' => $request->country_of_origin,
            'remark' => $request->remark,
            'usage_level' => $request->usage_level,
            'harga_ex_work_USD' => $request->harga_ex_work_USD,
            'harga_CIF_USD' => $request->harga_CIF_USD,
            'harga_MOQ_USD' => $request->harga_MOQ_USD,
            'appearance' => $request->appearance,
            'color_rangeColor' => $request->color_rangeColor,
            'odour_taste' => $request->odour_taste,
            'material' => $request->material,
            'spesific_gravity_d20' => $request->spesific_gravity_d20,
            'spesific_gravity_d25' => $request->spesific_gravity_d25,
            'refractive_index_d20' => $request->refractive_index_d20,
            'refractive_index_d25' => $request->refractive_index_d25,
            'berat_gram' => $request->berat_gram,
        ]);

        return redirect('/barang')->with('success', 'Data berhasil diperbarui');
    }


    public function export()
    {
        return Excel::download(new BarangExport, 'BarangTerdaftar.xlsx');
    }
}
