<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Permintaan;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
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

    public function permintaan_print(Request $request) {
        $tanggal = $request->input('tanggal');
    
        $carbonDate = Carbon::createFromFormat('Y-m-d', $tanggal);
    
        $formattedDate = $carbonDate->isoFormat('MMMM, DD YYYY');
    
        $yesterday = $carbonDate->subDay()->isoFormat('MMMM, DD YYYY');
    
        $filteredData = Permintaan::whereDate('tanggal', '=', $tanggal)->get();
        $yesterdayData = Permintaan::whereDate('tanggal', '=', $yesterday)->get();
    
        $pdf = FacadePdf::loadView('form.printOut.permintaan', [
            'filteredData' => $filteredData,
            'tanggal' => $formattedDate,
            'yesterday' => $yesterday,
            'yesterdayData' => $yesterdayData
        ])->setPaper('a4', 'portrait');
    
        // Stream PDF
        return $pdf->stream('filtered_data.pdf');
    }
    
}
