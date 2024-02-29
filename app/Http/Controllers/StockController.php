<?php

namespace App\Http\Controllers;

use App\Exports\RekapExport;
use App\Models\Packaging;
use App\Models\Stock;
use App\Models\StockBarang;
use App\Models\UsageData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

        $startDate = Carbon::today()->subWeek()->startOfMonth();
        $endDate = Carbon::today()->subWeek()->endOfMonth();

        $usageQuantities = UsageData::whereBetween('tanggal_penggunaan', [$startDate, $endDate])
            ->groupBy('FAI_code')
            ->selectRaw('FAI_code, SUM(pemakaian) as total_usage')
            ->get();
        return view('stock.stock', compact('stock', 'usageQuantities'));
    }

    public function rekap()
    {
        $usages = UsageData::orderBy('tanggal_penggunaan')->get();

        $monthlyUsages = [];

        foreach ($usages as $usage) {
            $month = Carbon::parse($usage->tanggal_penggunaan)->format('F');

            if (!isset($monthlyUsages[$month])) {
                $monthlyUsages[$month] = [];
            }

            if (!isset($monthlyUsages[$month][$usage->FAI_code])) {
                $monthlyUsages[$month][$usage->FAI_code] = 0;
            }

            $monthlyUsages[$month][$usage->FAI_code] += $usage->pemakaian;
        }
        return view('barang.rekapPenggunaan', compact('monthlyUsages'));
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

    public function exportDataPerMonth($month)
    {
        return Excel::download(new RekapExport($month), 'rekap_penggunaan_' . $month . '.xlsx');
    }
}
