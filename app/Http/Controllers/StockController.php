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
        $stlot = Stock::with('brgMasuk', 'qc_check')->orderBy('created_at', 'desc')->paginate(15);
        return view('stock.stockLot', ['stlot' => $stlot]);
    }

    public function stock()
    {
        $stock = StockBarang::with(['stockLots' => function ($query) {
            $query->where('FAI_code', 'FAI_code') // Replace 'FAI_code' with the actual code
                ->latest()
                ->take(1); // Retrieve only the latest stockLots for each StockBarang
        }, 'barang'])
            ->orderBy('updated_at', 'desc')
            ->paginate(15);


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

            $stock = StockBarang::where('FAI_code', 'like', '%' . $searchTerm . '%')
                ->orWhere('product_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('aspect', 'like', '%' . $searchTerm . '%')
                ->paginate(8);

            $startDate = Carbon::today()->subWeek()->startOfMonth();
            $endDate = Carbon::today()->subWeek()->endOfMonth();

            $usageQuantities = UsageData::whereBetween('tanggal_penggunaan', [$startDate, $endDate])
                ->groupBy('FAI_code')
                ->selectRaw('FAI_code, SUM(pemakaian) as total_usage')
                ->get();

            return view('stock.stock', ['stock' => $stock, 'usageQuantities' => $usageQuantities]);
        } catch (\Exception $e) {
            return redirect('stock/barang');
        }
    }

    public function search_lot(Request $request)
    {
        try {
            $searchTerm = $request->input('search');

            $stlot = Stock::with('brgMasuk')->where('FAI_code', 'like', '%' . $searchTerm . '%')
                ->orWhere('no_LOT', 'like', '%' . $searchTerm . '%')
                ->orWhere('quantity', 'like', '%' . $searchTerm . '%')
                ->paginate(8);

            return view('stock.stockLot', ['stlot' => $stlot]);
        } catch (\Exception $e) {
            return redirect('stock/barang');
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
