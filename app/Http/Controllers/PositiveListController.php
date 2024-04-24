<?php

namespace App\Http\Controllers;

use App\Imports\casImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PositiveListController extends Controller
{
    public function import_cas()
    {
        Excel::import(new casImport, request()->file('file'));
        return redirect()->back()->with('success', 'cas imported successfully!');
    }

    public function cas()
    {
        return view('CAS.cas');
    }
}
