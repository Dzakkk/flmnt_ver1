<?php

namespace App\Imports;

use App\Models\BarangKeluar;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class KeluarImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $tanggal_keluar = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]);
            $no_LOT = !empty($row[4]) ? $row[4] : 'sisa';
            $tanggal_expire = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]) : null;

            $NoSuratJalanMasuk_NoProduksi = !empty($row[7]) ? $row[7] : 'kosong';
            $NoPO_NoWO = !empty($row[8]) ? $row[8] : 'kosong';
            $qty_keluar_LOT = !empty($row[9]) ? $row[9] : 0; // Set default to 0 if empty
            $note = !empty($row[6]) ? $row[6] : 'note';

            BarangKeluar::updateOrCreate(
                ['FAI_code' => $row[2]],
                [
                    'tanggal_keluar' => $tanggal_keluar,
                    'no_LOT' => $no_LOT,
                    'tanggal_expire' => $tanggal_expire,
                    'NoSuratJalanMasuk_NoProduksi' => $NoSuratJalanMasuk_NoProduksi,
                    'NoPO_NoWO' => $NoPO_NoWO,
                    'qty_keluar_LOT' => $qty_keluar_LOT,
                    'note' => $note,
                ]
            );

        }
    }
}
