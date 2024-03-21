<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Stock;
use App\Models\StockBarang;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class BarangImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        
        foreach ($rows as $row) {
            Barang::create([
                'FAI_code' => $row[0],
                'FINA_code' => $row[1],
                'name' => $row[2],
            ]);

            Stock::create([
                'FAI_code' => $row[0],
                'no_LOT' => 'sisa',
                'quantity' => $row[3],
            ]);

            StockBarang::create([
                'FAI_code' => $row[0],
                'FINA_code' => $row[1],
                'product_name' => $row[2],
            ]);
        }
    }
}
