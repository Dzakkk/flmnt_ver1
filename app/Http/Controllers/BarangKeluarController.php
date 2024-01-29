<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Customer;
use App\Models\RakGudang;
use App\Models\Stock;
use App\Models\StockBarang;
use App\Models\stockProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $prd = stockProduct::all();
        return view('barang.barangKeluar', ['brgkeluar' => $brgkeluar, 'rak' => $rak, 'cust' => $cust, 'brg' => $brg, 'stock' => $stock, 'prd' => $prd]);
    }

    // private function isStockSufficient(Request $request)
    // {
    //     $requestedWeight = $request->total_qty_keluar_LOT;
    //     $availableStock = Stock::where('FAI_code', $request->FAI_code)->sum('weight');

    //     return $requestedWeight <= $availableStock;
    // }

    // public function brgKeluar(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'jenis_pengeluaran' => 'required',
    //         'tanggal_keluar' => 'required',
    //         'shipment' => 'required',
    //         'id_customer' => 'required',
    //         'NoSuratJalankeluar_NoProduksi' => 'required',
    //         'NoPO_NoWO' => 'required',
    //         'FAI_code' => 'required',
    //         'no_LOT' => 'required',
    //         'tanggal_produksi' => 'required',
    //         'tanggal_expire' => 'required',
    //         'coa_documentation' => 'required_without_all:tds_documentation,msds_documentation',
    //         'tds_documentation' => 'required_without_all:coa_documentation,msds_documentation',
    //         'msds_documentation' => 'required_without_all:coa_documentation,tds_documentation',
    //         'total_qty_keluar_LOT' => 'required',
    //         'unit' => 'required',
    //         'berat_per_kemasan_KG' => 'required',
    //         'jenis_kemasan' => 'required',
    //         'kategori_barang' => 'required',
    //         'total_QTY_kemasan' => 'required',
    //         'status' => 'required',
    //         'id_rak' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return dd($validator)
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     if (!$this->isStockSufficient($request)) {
    //         return redirect('barangKeluar')
    //             ->with('error', 'Stock is not sufficient.');
    //     }

    //     $documentation = implode(',', $request->only(['coa_documentation', 'tds_documentation', 'msds_documentation']));

    //     $barangKeluar = new BarangKeluar([
    //         'jenis_pengeluaran' => $request->jenis_pengeluaran,
    //         'tanggal_keluar' => $request->tanggal_keluar,
    //         'shipment' => $request->shipment,
    //         'id_customer' => $request->id_customer,
    //         'NoSuratJalankeluar_NoProduksi' => $request->NoSuratJalankeluar_NoProduksi,
    //         'NoPO_NoWO' => $request->NoPO_NoWO,
    //         'FAI_code' => $request->FAI_code,
    //         'no_LOT' => $request->no_LOT,
    //         'tanggal_produksi' => $request->tanggal_produksi,
    //         'tanggal_expire' => $request->tanggal_expire,
    //         'dokumen' => $documentation,
    //         'total_qty_keluar_LOT' => $request->total_qty_keluar_LOT,
    //         'unit' => $request->unit,
    //         'berat_per_kemasan_KG' => $request->berat_per_kemasan_KG,
    //         'jenis_kemasan' => $request->jenis_kemasan,
    //         'kategori_barang' => $request->kategori_barang,
    //         'total_QTY_kemasan' => $request->total_QTY_kemasan,
    //         'status' => $request->status,
    //         'id_rak' => $request->id_rak,
    //     ]);

    //     try {
    //         $barangKeluar->save();
    //     } catch (\Exception $e) {
    //         dd($e->getMessage());
    //     }

    //     $rakGudang = RakGudang::find($request->id_rak);
    //     $rakGudang->kapasitas += $request->total_qty_keluar_LOT;
    //     $rakGudang->save();
    //     try {
    //         $barangKeluar->save();
    //     } catch (\Exception $e) {
    //         dd($e->getMessage());
    //     }        

    //     $requestedWeight = $request->total_qty_keluar_LOT;
    //     $availableStock = Stock::where('FAI_code', $request->FAI_code)->sum('weight');

    //     if ($requestedWeight > $availableStock) {
    //         $barangKeluar->decreaseStock($availableStock);
    //         return redirect('barangKeluar')->with('warning', 'Partial stock issued.');
    //     } else {
    //         $barangKeluar->decreaseStock($requestedWeight);
    //         return redirect('barangKeluar')->with('success', 'Stock issued successfully.');
    //     }





    private function isStockSufficient(Request $request)
    {
        $requestedWeight = $request->total_qty_keluar_LOT;
        $availableStock = Stock::where('FAI_code', $request->FAI_code)->sum('weight');

        $requestedWeight2 = $request->total_qty_keluar_LOT;
        $availableStock2 = StockBarang::where('FAI_code', $request->FAI_code)->sum('quantity');

        return $requestedWeight <= $availableStock;
        $requestedWeight2 <= $availableStock2;
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
            return redirect('barangKeluar')
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

       

        $FAI_code = $request->FAI_code;
        $rakGudang = RakGudang::whereHas('stocks', function ($query) use ($FAI_code) {
            $query->where('FAI_code', $FAI_code);
        })->find($request->id_rak);

        if (!$rakGudang) {
            session()->flash('error', 'Gagal');

            return redirect('barangKeluar')->with('error', 'Rak Gudang not found for the specified FAI_code.');
        }

        $rakGudang->kapasitas += $request->total_qty_keluar_LOT;

        try {
            $rakGudang->save();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal');
        }

        try {
            $barangKeluar->save();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal');
            return redirect('barangKeluar')
                ->with('error', 'Failed to save BarangKeluar: ' . $e->getMessage());
        }


        $requestedWeight = $request->total_qty_keluar_LOT;
        $availableStock = Stock::where('FAI_code', $request->FAI_code)->sum('weight');

        $requestedWeight2 = $request->total_qty_keluar_LOT;
        $availableStock2 = StockBarang::where('FAI_code', $request->FAI_code)->sum('quantity');

        if ($requestedWeight > $availableStock && $requestedWeight2 > $availableStock2) {
            // If requested quantity is more than available stock
            return redirect('barangKeluar')->with('warning', 'Partial stock issued. Requested quantity exceeds available stock.');
            session()->flash('error', 'Gagal');

        } else {
            // If requested quantity is within available stock
            try {
                $this->decreaseStock($request->FAI_code, $requestedWeight);
                $this->decreaseStockBarang($request->FAI_code, $requestedWeight2);
            } catch (\Exception $e) {
                return redirect('barangKeluar')
                    ->with('error', 'Failed to decrease stock: ' . $e->getMessage());
            }
            session()->flash('success', 'Berhasil');
            return redirect('barangKeluar')->with('success', 'Stock issued successfully.');
        }
    }

    private function decreaseStock($FAI_code, $requestedWeight)
    {
        $stocks = Stock::where('FAI_code', $FAI_code)->orderBy('created_at')->get();

        foreach ($stocks as $stock) {
            if ($requestedWeight >= $stock->weight) {
                // If requested weight is greater than or equal to current stock weight, delete the stock entry
                session()->flash('error', 'Quantity Kurang');
                $stock->delete();
                $requestedWeight -= $stock->weight;
            } else {
                // If requested weight is less than the current stock weight, update the stock entry
                $stock->update(['weight' => $stock->weight - $requestedWeight]);
                break;
            }
        }
    }

    private function decreaseStockBarang($FAI_code, $requestedWeight)
    {
        $stocks = StockBarang::where('FAI_code', $FAI_code)->orderBy('created_at')->get();

        foreach ($stocks as $stock) {
            if ($requestedWeight >= $stock->quantity) {
                // If requested weight is greater than or equal to current stock weight, delete the stock entry
                session()->flash('error', 'Quantity Kurang');
                $stock->update(['quantity' => 0]);
                $requestedWeight -= $stock->quantity;
            } else {
                // If requested weight is less than the current stock weight, update the stock entry
                $stock->update(['quantity' => $stock->quantity - $requestedWeight]);
                break;
            }
        }
    }


public function getRakOptions(Request $request)
{
    $FAI_code = $request->FAI_code;
    
    // Retrieve Rak options based on the FAI_code from the Barang Masuk table
    $rakOptions = DB::table('barang_masuk')
                    ->join('rak_gudang', 'barang_masuk.id_rak', '=', 'rak_gudang.id_rak')
                    ->where('barang_masuk.FAI_code', $FAI_code)
                    ->select('rak_gudang.id_rak')
                    ->distinct()
                    ->get();

    return response()->json(['options' => $rakOptions]);
}

}
