<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Packaging;
use App\Models\Stock;
use App\Models\StockBarang;
use Carbon\Carbon;
use Illuminate\Database\Events\TransactionBeginning;
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
        $stock = StockBarang::with('stockLots', 'barang')->get();

        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $usageQuantity = Stock::whereBetween('created_at', [$startDate, $endDate])
                    ->groupBy('FAI_code')
                    ->selectRaw('FAI_code, SUM(quantity) as total_usage')
                    ->get();

        return view('stock.stock', compact('stock', 'usageQuantity'));
    }

    public function packaging()
    {
        $package = Packaging::all();
        return view('stock.kemasan', compact('package'));
    }

    public function search(Request $request)
    {
        try {
            $searchTerm = $request->input('search');

            $stlot = Stock::where('FAI_code', 'like', '%' . $searchTerm . '%')
                ->orWhere('no_LOT', 'like', '%' . $searchTerm . '%')
                ->orWhere('id_rak', 'like', '%' . $searchTerm . '%')
                ->get();

            return response()->json(['stlot' => $stlot]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function view()
    {
        return view('form.pControl');
    }
    public function view2()
    {
        return view('form.formPDF');
    }
}
