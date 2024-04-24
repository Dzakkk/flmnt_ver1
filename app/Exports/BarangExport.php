<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Barang::orderBy('name', 'asc')->get();
    }

    public function headings(): array 
    {
        return [
            'FAI code',
            // 'FINA code',
            // 'kategori barang',
            // 'aspect',
            // 'initial code',
            // 'number code',
            // 'alokasi penyimpanan',
            // 'reOrder qty',
            // 'unit',
            // 'supplier',
            // 'packaging type',
            // 'Documentation',
            // 'halal certification',
            'name',
            // 'common name',
            // 'brandProduct code',
            // 'chemical IUPACname',
            // 'CAS number',
            // 'ex origin',
            // 'initial ex',
            // 'country of origin',
            // 'remark',
            // 'usage level',
            // 'harga ex work USD',
            // 'harga CIF USD',
            // 'harga MOQ USD',
            // 'appearance',
            // 'color rangeColor',
            // 'odour taste',
            // 'material',
            // 'spesific gravity d20',
            // 'spesific gravity d25',
            // 'refractive index d20',
            // 'refractive index d25',
            // 'berat gram',
        ];
    }
}
