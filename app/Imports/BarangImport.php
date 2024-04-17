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
            Barang::updateOrCreate(
                ['FAI_code' => $row[0]],
                ['FINA_code' => $row[0], 'name' => $row[1]]
            );

            Stock::updateOrCreate(
                ['FAI_code' => $row[0]],
                ['no_LOT' => 'sisa', 'quantity' => $row[2]]
            );

            StockBarang::updateOrCreate(
                ['FAI_code' => $row[0]],
                ['FINA_code' => $row[0], 'product_name' => $row[1]]
            );
        }
    }
}
