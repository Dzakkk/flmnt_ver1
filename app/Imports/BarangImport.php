<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Stock;
use App\Models\StockBarang;
use Maatwebsite\Excel\Concerns\ToModel;

class BarangImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $barang = new Barang([
            'FAI_code' => $row[0],
            'FINA_code' => $row[1],
            'name' => $row[2],
        ]);
        $barang->save();

        $stock = new Stock([
            'FAI_code' => $row[0],
            'no_LOT' => 'sisa',
            'quantity' => $row[3],
        ]);
        $stock->save();

        $stockBarang = new StockBarang([
            'FAI_code' => $row[0],
            'FINA_code' => $row[1],
            'product_name' => $row[2],
        ]);
        $stockBarang->save();

        return $barang;
        
    }
}
