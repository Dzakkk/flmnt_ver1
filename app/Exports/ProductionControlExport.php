<?php

namespace App\Exports;

use App\Models\ProductionControl;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductionControlExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProductionControl::with('stockl')->get();
         
    }
}
