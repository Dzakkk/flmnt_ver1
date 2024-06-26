<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Customer;
use App\Models\ProductionControl;
use App\Models\Products;
use App\Models\QualityControl;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QualityControlController extends Controller
{
    public function qc_check()
    {

        $brg = BarangMasuk::with('qc_check')
            ->whereHas('qc_check')->paginate(1);

        $prd = ProductionControl::with('qc_check')
            ->whereHas('qc_check')->paginate(1);

        $qc = QualityControl::paginate(5);
        return view('quality_control.qualityCheck', compact('qc', 'brg', 'prd'));
    }

    public function qc_form_inhouse($id)
    {
        $parts = explode('_', $id, 2);

        $no_production = $parts[0] ?? null;
        $no_LOT = $parts[1] ?? null;

        $cust = Customer::all();

        $nl = Stock::where('no_LOT', $no_LOT)->where('no_production', $no_production)->first();

        $fai = Stock::where('no_LOT', $no_LOT)->where('no_production', $no_production)->value('FAI_code');

        $prd = Products::where('FAI_code', $fai)->first();

        return view('quality_control.qualityInhouseForm', compact('nl', 'prd', 'cust'));
    }

    public function qc_form_inhouse_update($id)
    {
        $parts = explode('_', $id, 2);

        $no_production = $parts[0] ?? null;
        $no_LOT = $parts[1] ?? null;

        $qc = QualityControl::where('no_production', $no_production)->where('LOT', $no_LOT)->first();

        $cust = Customer::all();

        $nl = Stock::where('no_LOT', $no_LOT)->where('no_production', $no_production)->first();

        $fai = Stock::where('no_LOT', $no_LOT)->where('no_production', $no_production)->value('FAI_code');

        $prd = Products::where('FAI_code', $fai)->first();

        return view('quality_control.updateInhouse', compact('qc', 'nl', 'prd', 'cust'));
    }

    public function qc_form_incoming($id)
    {
        $parts = explode('_', $id, 3);

        $tanggal = $parts[0] ?? null;
        $no_LOT = $parts[1] ?? null;
        $brg = $parts[2] ?? null;

        $cust = Customer::all();

        $nl = Stock::where('no_LOT', $no_LOT)->where('created_at', $tanggal)->first();

        $fai = Stock::where('no_LOT', $no_LOT)->where('created_at', $tanggal)->value('FAI_code');

        $prd = Barang::where('FAI_code', $fai)->first();

        return view('quality_control.qualityIncomingForm', compact('nl', 'prd', 'cust'));
    }

    public function qc_form_incoming_update($id)
    {
        $parts = explode('_', $id, 3);

        $tanggal = $parts[0] ?? null;
        $no_LOT = $parts[1] ?? null;
        $brg = $parts[2] ?? null;

        $qc = QualityControl::where('LOT', $no_LOT)->where('created_at', $tanggal)->first();

        $cust = Customer::all();

        $nl = Stock::where('no_LOT', $no_LOT)->where('created_at', $tanggal)->first();

        $fai = Stock::where('no_LOT', $no_LOT)->where('created_at', $tanggal)->value('FAI_code');

        $prd = Barang::where('FAI_code', $fai)->first();

        return view('quality_control.updateIncoming', compact('qc', 'nl', 'prd', 'cust'));
    }

    public function qc_product()
    {
        $brg = BarangMasuk::with('stockL', 'barang', 'qc_check')
            ->get()
            ->sortBy(function ($item) {
                return optional($item->qc_check)->status;
            });

        $pro = ProductionControl::with('stockl', 'product', 'qc_check')
            ->get()
            ->sortBy (function ($item) {
                return optional($item->qc_check)->status;
            });

        return view('quality_control.productCheck', compact('brg', 'pro'));
    }

    public function qc_post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'LOT' => 'required',
            'product_name' => 'required',
            'FAI_code' => 'required',
            'qty' => 'required',
            'test_methode' => 'required',
            'no_production' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('your-form-route')
                ->withErrors($validator)
                ->withInput();
            // dd($validator);
        }

        $odour = $request->odour_value;

        if ($odour < 2) {
            $odour_result = 'Pass';
        } else if ($odour > 3) {
            $odour_result = 'Reject';
        } else {
            $odour_result = 'Need Verification';
        }

        $color = $request->color_value;

        if ($color < 2) {
            $color_result = 'Pass';
        } else if ($color > 3) {
            $color_result = 'Reject';
        } else {
            $color_result = 'Need Verification';
        }

        $taste = $request->taste_value;

        if ($taste < 2) {
            $taste_result = 'Pass';
        } else if ($taste > 3) {
            $taste_result = 'Reject';
        } else {
            $taste_result = 'Need Verification';
        }

        $qc = new QualityControl([
            'LOT' => $request->LOT,
            'product_name' => $request->product_name,
            'FAI_code' => $request->FAI_code,
            'no_production' => $request->no_production,
            'qty' => $request->qty,
            'customer' => $request->customer,
            'tanggal_produksi' => $request->tanggal_produksi,
            'test_methode' => $request->test_methode,
            'appereance' => $request->appereance,
            'range_color' => $request->range_color,
            'odour_taste' => $request->odour_taste,
            'sg_d20_min' => $request->sg_d20_min,
            'sg_d20_max' => $request->sg_d20_max,
            'sg_d20_target' => $request->sg_d20_target,
            'sg_d25_min' => $request->sg_d25_min,
            'sg_d25_max' => $request->sg_d25_max,
            'sg_d25_target' => $request->sg_d25_target,
            'ri_d20_min' => $request->ri_d20_min,
            'ri_d20_max' => $request->ri_d20_max,
            'ri_d20_target' => $request->ri_d20_target,
            'ri_d25_min' => $request->ri_d25_min,
            'ri_d25_max' => $request->ri_d25_max,
            'ri_d25_target' => $request->ri_d25_target,
            'sg_d20_value' => $request->sg_d20_value,
            'sg_d25_value' => $request->sg_d25_value,
            'ri_d20_value' => $request->ri_d20_value,
            'ri_d25_value' => $request->ri_d25_value,
            'sg_d20_result' => $request->sg_d20_result,
            'sg_d25_result' => $request->sg_d25_result,
            'ri_d20_result' => $request->ri_d20_result,
            'ri_d25_result' => $request->ri_d25_result,
            'color_value' => $request->color_value,
            'odour_value' => $request->odour_value,
            'taste_value' => $request->taste_value,
            'color_result' => $color_result,
            'odour_result' => $odour_result,
            'taste_result' => $taste_result,
            'note' => $request->note,
            'status' => $request->status,
        ]);

        $qc->save();

        return redirect('/qc/check/data');
    }

    public function qc_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'LOT' => 'required',
            'product_name' => 'required',
            'FAI_code' => 'required',
            'qty' => 'required',
            'test_methode' => 'required',
            'no_production' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            // return redirect('your-form-route')
            //     ->withErrors($validator)
            //     ->withInput();
            dd($validator);
        }

        $odour = $request->odour_value;

        if ($odour < 2) {
            $odour_result = 'Pass';
        } else if ($odour > 3) {
            $odour_result = 'Reject';
        } else {
            $odour_result = 'Need Verification';
        }

        $color = $request->color_value;

        if ($color < 2) {
            $color_result = 'Pass';
        } else if ($color > 3) {
            $color_result = 'Reject';
        } else {
            $color_result = 'Need Verification';
        }

        $taste = $request->taste_value;

        if ($taste < 2) {
            $taste_result = 'Pass';
        } else if ($taste > 3) {
            $taste_result = 'Reject';
        } else {
            $taste_result = 'Need Verification';
        }

        $qc = QualityControl::find($id);

        $qc->update([
            'LOT' => $request->LOT,
            'product_name' => $request->product_name,
            'FAI_code' => $request->FAI_code,
            'no_production' => $request->no_production,
            'qty' => $request->qty,
            'customer' => $request->customer,
            'tanggal_produksi' => $request->tanggal_produksi,
            'test_methode' => $request->test_methode,
            'appereance' => $request->appereance,
            'range_color' => $request->range_color,
            'odour_taste' => $request->odour_taste,
            'sg_d20_min' => $request->sg_d20_min,
            'sg_d20_max' => $request->sg_d20_max,
            'sg_d20_target' => $request->sg_d20_target,
            'sg_d25_min' => $request->sg_d25_min,
            'sg_d25_max' => $request->sg_d25_max,
            'sg_d25_target' => $request->sg_d25_target,
            'ri_d20_min' => $request->ri_d20_min,
            'ri_d20_max' => $request->ri_d20_max,
            'ri_d20_target' => $request->ri_d20_target,
            'ri_d25_min' => $request->ri_d25_min,
            'ri_d25_max' => $request->ri_d25_max,
            'ri_d25_target' => $request->ri_d25_target,
            'sg_d20_value' => $request->sg_d20_value,
            'sg_d25_value' => $request->sg_d25_value,
            'ri_d20_value' => $request->ri_d20_value,
            'ri_d25_value' => $request->ri_d25_value,
            'sg_d20_result' => $request->sg_d20_result,
            'sg_d25_result' => $request->sg_d25_result,
            'ri_d20_result' => $request->ri_d20_result,
            'ri_d25_result' => $request->ri_d25_result,
            'color_value' => $request->color_value,
            'odour_value' => $request->odour_value,
            'taste_value' => $request->taste_value,
            'color_result' => $color_result,
            'odour_result' => $odour_result,
            'taste_result' => $taste_result,
            'note' => $request->note,
            'status' => $request->status,
        ]);

        $qc->save();

        return redirect('/qc/check/data');
    }
}
