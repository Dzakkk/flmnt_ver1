<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Imports\BarangImport;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Manufacturer;
use App\Models\Packaging;
use App\Models\PositiveList;
use App\Models\Stock;
use App\Models\StockBarang;
use App\Models\Supplier;
use App\Models\UsageData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    public function dataBarang()
    {
        $brg = Barang::with('stock')->paginate(15);
        $supp = Supplier::all();
        $ex = Manufacturer::all();
        $startDate = Carbon::today()->subWeek()->startOfMonth();
        $endDate = Carbon::today()->subWeek()->endOfMonth();

        $usageQuantities = UsageData::whereBetween('tanggal_penggunaan', [$startDate, $endDate])
            ->groupBy('FAI_code')
            ->selectRaw('FAI_code, SUM(pemakaian) as total_usage')
            ->get();

        return view('barang.dataBarang', ['brg' => $brg, 'supp' => $supp, 'ex' => $ex, 'usageQuantities' => $usageQuantities]);
    }

    public function search(Request $request)
    {
        try {
            $searchTerm = $request->input('search');

            $brg = Barang::with('stock')->where('FAI_code', 'like', '%' . $searchTerm . '%')
                ->orWhere('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('aspect', 'like', '%' . $searchTerm . '%')
                ->paginate(15);
            $supp = Supplier::all();
            $ex = Manufacturer::all();

            $startDate = Carbon::today()->subWeek()->startOfMonth();
            $endDate = Carbon::today()->subWeek()->endOfMonth();

            $usageQuantities = UsageData::whereBetween('tanggal_penggunaan', [$startDate, $endDate])
                ->groupBy('FAI_code')
                ->selectRaw('FAI_code, SUM(pemakaian) as total_usage')
                ->get();
            return view('barang.dataBarang', ['brg' => $brg, 'supp' => $supp, 'ex' => $ex, 'usageQuantities' => $usageQuantities]);
        } catch (\Exception $e) {
            return redirect('/barang');
        }
    }

    public function import()
    {
        Excel::import(new BarangImport, request()->file('file'));
        return redirect()->back()->with('success', 'Users imported successfully!');
    }

    public function newBarangForm()
    {
        $supp = Supplier::all();
        $mnc = Manufacturer::all();
        $cas = PositiveList::all();
        return view('barang.newBarang', ['cas' => $cas, 'supp' => $supp, 'ex' => $mnc]);
    }

    public function newBarang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'FAI_code' => 'required',
            // 'FINA_code' => 'required',
            // 'kategori_barang' => 'required',
            // 'aspect' => 'required',
            // 'initial_code' => 'required',
            // 'number_code' => 'required',
            // 'alokasi_penyimpanan' => 'required',
            // 'reOrder_qty' => 'required',
            // 'unit' => 'required',
            // 'supplier' => 'required',
            // 'packaging_type' => 'required',
            // 'coa_documentation' => 'required_without_all:tds_documentation,msds_documentation',
            // 'tds_documentation' => 'required_without_all:coa_documentation,msds_documentation',
            // 'msds_documentation' => 'required_without_all:coa_documentation,tds_documentation',
            // 'halal_certification' => 'required',
            // 'name' => 'required',
            // 'common_name' => 'required',
            // 'brandProduct_code' => 'required',
            // 'chemical_IUPACname' => 'required',
            // 'CAS_number' => 'required',
            // 'ex_origin' => 'required',
            // 'initial_ex' => 'required',
            // 'country_of_origin' => 'required',
            // 'remark' => 'required',
            // 'usage_level' => 'required',
            // 'harga_ex_work_USD' => 'required',
            // 'harga_CIF_USD' => 'required',
            // 'harga_MOQ_USD' => 'required',
            // 'appearance' => 'required',
            // 'color_rangeColor' => 'required',
            // 'odour_taste' => 'required',
            // 'material' => 'required',
            // 'spesific_gravity_d20' => 'required',
            // 'spesific_gravity_d25' => 'required',
            // 'refractive_index_d20' => 'required',
            // 'refractive_index_d25' => 'required',
            // 'berat_gram' => 'required',
        ]);
        // dd($validator);
        if ($validator->fails()) {
            return redirect('barangMasuk')
                ->withErrors($validator)
                ->withInput();
        }

        $documentation = implode(',', $request->only(['coa_documentation', 'tds_documentation', 'msds_documentation']));

        $supplier = Supplier::where('id_supplier', $request->supplier)->first();
        $origin = Manufacturer::where('manufacturer_name', $request->ex_origin)->first();

        if (!$supplier) {
            $supp = new Supplier([
                'supplier_name' => $request->supplier,
            ]);
            $supp->save();
        }

        if (!$origin) {
            $ex = new Manufacturer([
                'manufacturer_name' => $request->ex_origin,
            ]);

            $ex->save();
        }

        if ($request->CAS_number) {
            $cas = PositiveList::where('CAS', $request->CAS_number)->value('nama_kimia')->get();
        }
        $pl = $cas ? 'Positive List' : 'Bukan Termasuk Positive List';

        // Jika nomor CAS ada dalam daftar positif, dekode nilai $cas
        $cas_n = $cas ? json_decode($cas) : null;

        if ($request->kategori_barang === 'PACKAGING') {
            $kemasan = new Packaging([
                'FAI_code' => $request->FAI_code,
                'nama_kemasan' => $request->nama_kemasan,
                'supplier' => $request->supplier,
                'capacity' => $request->capacity,
                'quantity' => 0,
                'id_rak' => 'LOADING DECK',
            ]);
            $kemasan->save();
        } else {
            $barang = new Barang([
                'FAI_code' => $request->FAI_code,
                'FINA_code' => $request->FINA_code,
                'kategori_barang' => $request->kategori_barang,
                'aspect' => $request->aspect,
                // 'initial_code' => $request->initial_code,
                // 'number_code' => $request->number_code,
                // 'alokasi_penyimpanan' => $request->alokasi_penyimpanan,
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

                'kimia' => $cas_n,
                'pl' => $pl,

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
                'alergen' => $request->alergen,
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
                'berat_gram' => $request->berat_gram,
            ]);

            $barang->save();
        }
        session()->flash('success', 'Data telah Ditambahkan');
        return redirect('/barang')->with('success', 'Barang berhasil ditambahkan');
    }


    public function update_file(Request $request, $id)
    {
        $request->validate([
            'file.*' => 'nullable|file|max:10240',
        ]);

        $barang = Barang::findOrFail($id);

        // dd($request->all(), $id);
        // Menghapus file lama jika ada
        if ($request->has('deleted_file')) {
            $deletedFile = $request->input('deleted_file');
            $filePath = public_path('document_barang') . '/' . $deletedFile;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            // Menghapus file dari daftar file yang disimpan di database
            $fileNames = json_decode($barang->file, true);
            $index = array_search($deletedFile, $fileNames);
            if ($index !== false) {
                unset($fileNames[$index]);
                $barang->file = json_encode(array_values($fileNames)); // Mengatur kembali array ke string JSON setelah menghapus file
            }
        }

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $fileName = $file->getClientOriginalName();
                $file->move(public_path('document_barang'), $fileName);
                $fileNames[] = $fileName;
            }
            $barang->file = json_encode($fileNames);
        }

        $barang->save();

        return redirect()->back()->with('success', 'Bertambah');
    }


    public function addFile(Request $request, $id)
    {
        $request->validate([
            'file.*' => 'nullable|file|max:10240',
        ]);

        $barang = Barang::findOrFail($id);
        // dd($barang, $request->all());
        $fileNames = [];
        if ($barang->file) {
            $fileNames = json_decode($barang->file, true);
        }

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $files) {
                $fileName = $files->getClientOriginalName();
                $files->move(public_path('document_barang'), $fileName);
                $fileNames[] = $fileName;
            }

            $barang->file = json_encode($fileNames);
        }

        $barang->save();

        return redirect()->back()->with('success', 'Telah Diubah+');
    }

    public function delete_file(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        // dd($request->all(), $id);
        // Menghapus file lama jika ada
        if ($request->has('deleted_file')) {
            $deletedFile = $request->input('deleted_file');
            $filePath = public_path('document_barang') . '/' . $deletedFile;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            // Menghapus file dari daftar file yang disimpan di database
            $fileNames = json_decode($barang->file, true);
            $index = array_search($deletedFile, $fileNames);
            if ($index !== false) {
                unset($fileNames[$index]);
                $barang->file = json_encode(array_values($fileNames)); // Mengatur kembali array ke string JSON setelah menghapus file
            }
        }
        $barang->save();

        return redirect()->back()->with('success', 'Telah dihapus');
    }


    public function updateBarang(Request $request, $id)
    {
        $request->validate([
            'FAI_code' => 'required',
            'FINA_code' => 'required',
            // 'kategori_barang' => 'required',
            // 'aspect' => 'required',
            // // 'alokasi_penyimpanan' => 'required',
            // 'reOrder_qty' => 'required',
            // 'unit' => 'required',
            // 'supplier' => 'required',
            // 'packaging_type' => 'required',
            // 'coa_documentation' => 'required_without_all:tds_documentation,msds_documentation',
            // 'tds_documentation' => 'required_without_all:coa_documentation,msds_documentation',
            // 'msds_documentation' => 'required_without_all:coa_documentation,tds_documentation',
            // 'halal_certification' => 'required',
            // 'name' => 'required',
            // 'common_name' => 'required',
            // 'brandProduct_code' => 'required',
            // 'chemical_IUPACname' => 'required',
            // 'CAS_number' => 'required',
            // 'ex_origin' => 'required',
            // 'initial_ex' => 'required',
            // 'country_of_origin' => 'required',
            // 'remark' => 'required',
            // 'usage_level' => 'required',
            // 'harga_ex_work_USD' => 'required',
            // 'harga_CIF_USD' => 'required',
            // 'harga_MOQ_USD' => 'required',
            // 'appearance' => 'required',
            // 'color_rangeColor' => 'required',
            // 'odour_taste' => 'required',
            // 'material' => 'required',
            // 'berat_gram' => 'required',
        ]);

        // Combine selected documentation checkboxes into a string
        $documentation = implode(',', $request->only(['coa_documentation', 'tds_documentation', 'msds_documentation']));

        // Find the Barang model instance
        $barang = Barang::find($id);
        $stockBarang = StockBarang::find($id);
        $stockLot = Stock::where('FAI_code', $id)->first();

        if ($request->CAS_number) {
            $cas = PositiveList::where('CAS', $request->CAS_number)->value('nama_kimia')->get();
        }

        $pl = $cas ? 'Positive List' : 'Bukan Termasuk Positive List';

        // Jika nomor CAS ada dalam daftar positif, dekode nilai $cas
        $cas_n = $cas ? json_decode($cas) : null;

        // Update the fields
        $barang->update([
            'FAI_code' => $request->FAI_code,
            'FINA_code' => $request->FINA_code,
            'kategori_barang' => $request->kategori_barang,
            'aspect' => $request->aspect,
            // 'alokasi_penyimpanan' => $request->alokasi_penyimpanan,
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

            'kimia' => $cas_n,
            'pl' => $pl,

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
            'odour_taste' => $request->odour_taste,
            'material' => $request->material,
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
            'berat_gram' => $request->berat_gram,
        ]);

        $stockBarang->update([
            'FAI_code' => $request->FAI_code,
            'FINA_code' => $request->FAI_code,
            'aspect' => $request->aspect,
            'category' => $request->kategori_barang,
            'product_name' => $request->name
        ]);

        $stockLot->update([
            'FAI_code' => $request->FAI_code,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function export()
    {
        return Excel::download(new BarangExport, 'BarangTerdaftar.xlsx');
    }

    public function halal(Request $request, $id)
    {
        $request->validate([
            'halal_certification' => 'required',
            'halal_date' => 'required',
        ]);
        $halal = Barang::find($id);
        // dd($id, $halal, $request);
        $halal->update([
            'halal_certification' => $request->halal_certification,
            'halal_date' => $request->halal_date,
        ]);

        return redirect()->back()->with('success', 'Halal update successfully!');
    }
}
