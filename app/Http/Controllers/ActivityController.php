<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Customer;
use App\Models\ProductionControl;
use App\Models\Products;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\UsageData;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{

    public function activity()
    {
        $lastActivity = Activity::orderBy('created_at', 'desc')->paginate(6);

        $cust = Barang::all()->count();
        $supp = Products::all()->count();
        $startDate = Carbon::today()->subWeek()->startOfMonth();
        $endDate = Carbon::today()->subWeek()->endOfMonth();

        $usage = UsageData::whereBetween('tanggal_penggunaan', [$startDate, $endDate])
            ->groupBy('FAI_code')
            ->selectRaw('FAI_code, SUM(pemakaian) as total_usage')
            ->paginate('10');

        $out = BarangKeluar::orderBy('created_at', 'desc')->take(3)->get();

        // Mengambil data berdasarkan grup created_at dan menghitung jumlahnya
        $in = BarangMasuk::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->get();
        
        $out2 = BarangKeluar::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->get();

        $production = ProductionControl::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->get();

        $stocksTerbesar = Stock::select('FAI_code', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('FAI_code')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();

        $stocksTerkecil = Stock::select('FAI_code', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('FAI_code')
            ->orderBy('total_quantity')
            ->take(5)
            ->get();

        return view('home', compact('lastActivity', 'cust', 'supp', 'usage', 'in', 'out','out2','production', 'stocksTerkecil', 'stocksTerbesar'));
    }
}
