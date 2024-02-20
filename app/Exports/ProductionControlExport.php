<?php

namespace App\Exports;

use App\Models\ProductionControl;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ProductionControlExport implements FromView
{
    public function view(): View
    {
        return view('form.layoutExcel.productionControlLayout', [
            'prd' => ProductionControl::with('stockl', 'cust')->get()
        ]);
    }
}
