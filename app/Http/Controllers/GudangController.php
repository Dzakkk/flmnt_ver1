<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\RakGudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    // public function dataGudang()
    // {
    //     $gudang = Gudang::all();
    //     $rak = RakGudang::all();
    //     return view('gudang.dataGudang', ['gudang' => $gudang, 'rak' => $rak]);
    // }

    public function dataGudang()
    {
        $gudang = Gudang::with('rak')->get();
        return view('gudang.dataGudang', ['gudang' => $gudang]);

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
        ]);

        return redirect('/gudang');
    }
}
