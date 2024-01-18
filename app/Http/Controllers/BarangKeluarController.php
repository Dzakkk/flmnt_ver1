<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Customer;
use App\Models\RakGudang;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangKeluarController extends Controller
{
    public function dataKeluar()
    {
        $brgkeluar = BarangKeluar::all();
        $cust = Customer::all();
        $brg = Barang::all();
        $rak = RakGudang::all();
        $stock = Stock::all();
        return view('barang.barangKeluar', ['brgkeluar' => $brgkeluar, 'rak' => $rak, 'cust' => $cust, 'brg' => $brg, 'stock' => $stock]);
    }

    private function isStockSufficient(Request $request)
    {
        $requestedWeight = $request->total_qty_keluar_LOT;
        $availableStock = Stock::where('FAI_code', $request->FAI_code)->sum('weight');

        return $requestedWeight <= $availableStock;
    }

    public function brgKeluar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_pengeluaran' => 'required',
            'tanggal_keluar' => 'required',
            'shipment' => 'required',
            'id_customer' => 'required',
            'NoSuratJalankeluar_NoProduksi' => 'required',
            'NoPO_NoWO' => 'required',
            'FAI_code' => 'required',
            'no_LOT' => 'required',
            'tanggal_produksi' => 'required',
            'tanggal_expire' => 'required',
            'coa_documentation' => 'required_without_all:tds_documentation,msds_documentation',
            'tds_documentation' => 'required_without_all:coa_documentation,msds_documentation',
            'msds_documentation' => 'required_without_all:coa_documentation,tds_documentation',
            'total_qty_keluar_LOT' => 'required',
            'unit' => 'required',
            'berat_per_kemasan_KG' => 'required',
            'jenis_kemasan' => 'required',
            'kategori_barang' => 'required',
            'total_QTY_kemasan' => 'required',
            'status' => 'required',
            'id_rak' => 'required',
        ]);

        if ($validator->fails()) {
            return dd($validator)
                ->withErrors($validator)
                ->withInput();
        }

        if (!$this->isStockSufficient($request)) {
            return redirect('barangKeluar')
                ->with('error', 'Stock is not sufficient.');
        }

        $documentation = implode(',', $request->only(['coa_documentation', 'tds_documentation', 'msds_documentation']));

        $barangKeluar = new BarangKeluar([
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'tanggal_keluar' => $request->tanggal_keluar,
            'shipment' => $request->shipment,
            'id_customer' => $request->id_customer,
            'NoSuratJalankeluar_NoProduksi' => $request->NoSuratJalankeluar_NoProduksi,
            'NoPO_NoWO' => $request->NoPO_NoWO,
            'FAI_code' => $request->FAI_code,
            'no_LOT' => $request->no_LOT,
            'tanggal_produksi' => $request->tanggal_produksi,
            'tanggal_expire' => $request->tanggal_expire,
            'dokumen' => $documentation,
            'total_qty_keluar_LOT' => $request->total_qty_keluar_LOT,
            'unit' => $request->unit,
            'berat_per_kemasan_KG' => $request->berat_per_kemasan_KG,
            'jenis_kemasan' => $request->jenis_kemasan,
            'kategori_barang' => $request->kategori_barang,
            'total_QTY_kemasan' => $request->total_QTY_kemasan,
            'status' => $request->status,
            'id_rak' => $request->id_rak,
        ]);

        try {
            $barangKeluar->save();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $requestedWeight = $request->total_qty_keluar_LOT;
        $availableStock = Stock::where('FAI_code', $request->FAI_code)->sum('weight');

        if ($requestedWeight > $availableStock) {
            $barangKeluar->decreaseStock($availableStock);
            return redirect('barangKeluar')->with('warning', 'Partial stock issued.');
        } else {
            $barangKeluar->decreaseStock($requestedWeight);
            return redirect('barangKeluar')->with('success', 'Stock issued successfully.');
        }
    }
}
