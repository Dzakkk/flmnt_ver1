<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Permintaan;
use App\Models\Products;
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
        return view('barang.permintaanData', compact('pr', 'brg', 'prd'));
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

        return redirect('permintaan');
    }

    public function getLot(Request $request)
    {
        $kode = $request->kode;
        $lots = Stock::where('FAI_code', $kode)->get(['no_LOT']);

        return response()->json($lots);
    }
}
