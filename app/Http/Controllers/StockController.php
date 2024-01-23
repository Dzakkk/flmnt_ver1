<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Stock;
use App\Models\StockBarang;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function lot()
    {
        $stlot = Stock::with('brgMasuk')->get();
        return view('stock.stockLot', ['stlot' => $stlot]);
    }

    public function stock()
    {
        $stock = StockBarang::all();
        return view('stock.stock', ['stock' => $stock]);
    }
}
