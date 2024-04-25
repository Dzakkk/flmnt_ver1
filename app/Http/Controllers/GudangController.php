<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\RakGudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{


    public function dataGudang()
    {
        $gudang = Gudang::with('rak')->get();
        $rak = RakGudang::all();
        return view('gudang.dataGudang', ['gudang' => $gudang, 'rak' => $rak]);

    }

    public function storeRak(Request $request)
    {
        $request->validate([
            'id_rak' => 'required',
            'id_gudang' => 'required',
            'keterangan' => 'required',
            'posisi_lokasi' => 'required',
            'kapasitas' => 'required',
        ]);

        RakGudang::create([
            'id_rak' => $request->id_rak,
            'id_gudang' => $request->id_gudang,
            'keterangan' => $request->keterangan,
            'posisi_lokasi' => $request->posisi_lokasi,
            'kapasitas' => $request->kapasitas,
            'total_capacity' =>$request->kapasitas,
        ]);
        session()->flash('success', 'Fungsi berhasil diselesaikan!');
        return redirect('/gudang');
    }

    public function update($id) {
        $rg = RakGudang::where('id_rak', $id)->first();
        $gudang = Gudang::all();
        return view('gudang.editGudang', compact('rg', 'gudang'));
    }

    public function updateRak(Request $request, $id)
    {
        $request->validate([
            'id_rak' => 'required',
            'id_gudang' => 'required',
            'keterangan' => 'required',
            'posisi_lokasi' => 'required',
            'total_capacity' => 'required',
        ]);

        $rak = RakGudang::where('id_rak', $id)->first();

        $rak->update([
            'id_rak' => $request->id_rak,
            'id_gudang' => $request->id_gudang,
            'keterangan' => $request->keterangan,
            'posisi_lokasi' => $request->posisi_lokasi,
            'total_capacity' =>$request->total_capacity,
        ]);
        session()->flash('success', 'Fungsi berhasil diselesaikan!');
        return redirect('/gudang');
    }
}
