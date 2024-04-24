<?php

namespace App\Imports;

use App\Models\PositiveList;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CasImport implements ToCollection
{
    /**
    * @param Collection $rows
    *
    * @return void
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            PositiveList::create([
                'CAS' => $row[0],
                'nama_kimia' => $row[1],
            ]);
        }
    }
}
