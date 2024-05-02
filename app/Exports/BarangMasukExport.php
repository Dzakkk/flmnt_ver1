<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;

class BarangMasukExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BarangMasuk::orderBy('tanggal_masuk', 'desc')->get();
    }

    public function headings():array
    {
        return [
            'jenis_penerimaan',
            'tanggal_masuk',
            'id_supplier',
            'NoSuratJalanMasuk_NoProduksi',
            'NoPO_NoWO',
            'FAI_code',
            'no_LOT',
            'tanggal_produksi',
            'tanggal_expire',
            'qty_masuk_LOT',
            'unit',
            'status',
            'note'
        ];
    }
}
