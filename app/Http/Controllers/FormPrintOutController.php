<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class FormPrintOutController extends Controller
{
    public function kedatangan (Request $request) {

        $tanggal = $request->input('tanggal');
        $filteredData = BarangMasuk::whereDate('tanggal_masuk', '=', $tanggal)->get();

        $pdf = FacadePdf::loadView('form.printOut.kedatangan', ['filteredData' => $filteredData, 'tanggal' => $tanggal])->setPaper('a4', 'landscape');
    
        return $pdf->stream('filtered_data.pdf');
    
    }

    public function pengiriman (Request $request) {

        $tanggal = $request->input('tanggal');
        $filteredData = BarangKeluar::whereDate('tanggal_keluar', '=', $tanggal)->get();

        $pdf = FacadePdf::loadView('form.printOut.pengiriman', ['filteredData' => $filteredData, 'tanggal' => $tanggal])->setPaper('a4', 'landscape');
    
        return $pdf->stream('filtered_data.pdf');
    
    }

    public function permintaan_print (Request $request) {

        $tanggal = $request->input('tanggal');
        $filteredData = BarangKeluar::whereDate('tanggal_keluar', '=', $tanggal)->get();

        $pdf = FacadePdf::loadView('form.printOut.permintaan', ['filteredData' => $filteredData, 'tanggal' => $tanggal])->setPaper('a4', 'landscape');
    
        return $pdf->stream('filtered_data.pdf');
    
    }
}
