<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class BarangMasukExport implements FromView
{
    public function view(): View
    {
        return view('form.layoutExcel.brgMasukLayout', [
            'brg' => BarangMasuk::with('barang', 'product', 'package')->get()
        ]);
    }
}
