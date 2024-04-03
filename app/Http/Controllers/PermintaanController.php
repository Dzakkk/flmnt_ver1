<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Permintaan;
use App\Models\Products;
use App\Models\QualityControl;
use App\Models\RakGudang;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermintaanController extends Controller
{
    public function permintaan()
    {
        $pr = Permintaan::all();
        $brg = Barang::all();
        $prd = Products::all();
        $stock = Stock::all();
        return view('barang.permintaanData', compact('pr', 'brg', 'prd', 'stock'));
    }


    public function permintaan_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'kode' => 'required',
            'quantity' => 'required',
            'keterangan' => 'required',
            'request_by' => 'required',
            'departemen' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('barang')
                ->withErrors($validator)
                ->withInput();
        }

        $name = Barang::where('FAI_code', $request->kode)->value('name');


        $permintaan = new Permintaan([
            'tanggal' => $request->tanggal,
            'nama' => $name,
            'kode' => $request->kode,
            'LOT' => $request->LOT,
            'quantity' => $request->quantity,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'request_by' => $request->request_by,
            'departemen' => $request->departemen,
        ]);

        $permintaan->save();

        $lot = Stock::where('FAI_code', $request->kode)->where('no_LOT', $request->LOT)->first();
        $qty = Stock::where('FAI_code', $request->kode)->where('no_LOT', $request->LOT)->value('quantity');
        $lot->update([
            'quantity' => $qty -= $request->quantity,
        ]);

        $lot->save();

        $warehouse = Stock::where('FAI_code', $request->kode)->where('no_LOT', $request->LOT)->value('warehouse');
        $rak = RakGudang::where('id_rak', $warehouse)->first();
        $rak->kapasitas += $request->quantity;

        $rak->save();

        return redirect('permintaan');
    }

    public function getLot(Request $request)
    {
        $kode = $request->kode;
        $lots = Stock::where('FAI_code', $kode)->get(['no_LOT']);

        return response()->json($lots);
    }

    public function getStatus(Request $request)
    {
        $lot = $request->no_LOT;
        $status = QualityControl::where('LOT', $lot)->value('status');
        
        return response()->json(['status' => $status]);
    }
}
