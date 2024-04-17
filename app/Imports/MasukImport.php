<?php

namespace App\Imports;

use App\Models\BarangMasuk;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MasukImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $tanggal_masuk = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]);
            $no_LOT = !empty($row[4]) ? $row[4] : 'sisa';
            $tanggal_expire = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]) : null;

            $NoSuratJalanMasuk_NoProduksi = !empty($row[7]) ? $row[7] : 'kosong';
            $NoPO_NoWO = !empty($row[8]) ? $row[8] : 'kosong';
            $qty_masuk_LOT = !empty($row[9]) ? $row[9] : 0; // Set default to 0 if empty
            $note = !empty($row[6]) ? $row[6] : 'note';

            BarangMasuk::updateOrCreate(
                ['FAI_code' => $row[2]],
                [
                    'tanggal_masuk' => $tanggal_masuk,
                    'no_LOT' => $no_LOT,
                    'tanggal_expire' => $tanggal_expire,
                    'NoSuratJalanMasuk_NoProduksi' => $NoSuratJalanMasuk_NoProduksi,
                    'NoPO_NoWO' => $NoPO_NoWO,
                    'qty_masuk_LOT' => $qty_masuk_LOT,
                    'note' => $note,
                ]
            );

        }
    }
}
