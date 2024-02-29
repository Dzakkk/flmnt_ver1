<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Supplier;
use App\Models\UsageData;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller 
{

    public function activity() {
        $lastActivity = Activity::orderBy('created_at', 'desc')->paginate(10);

        $cust = Customer::all()->count();
        $supp = Supplier::all()->count();
        $startDate = Carbon::today()->subWeek()->startOfMonth();
        $endDate = Carbon::today()->subWeek()->endOfMonth();

        $usage = UsageData::whereBetween('tanggal_penggunaan', [$startDate, $endDate])
            ->groupBy('FAI_code')
            ->selectRaw('FAI_code, SUM(pemakaian) as total_usage')
            ->paginate('10');
        return view('home', compact('lastActivity', 'cust', 'supp', 'usage'));
    }

}