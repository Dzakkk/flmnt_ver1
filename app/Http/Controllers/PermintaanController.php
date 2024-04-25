<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\CustList;
use App\Models\Permintaan;
use App\Models\PositiveList;
use App\Models\Products;
use App\Models\QualityControl;
use App\Models\RakGudang;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Roman;

class PermintaanController extends Controller
{
    public function permintaan()
    {
        $pr = Permintaan::all();
        $brg = Barang::all();
        $prd = Products::all();
        $stock = Stock::all();
        return view('barang.permintaanData', compact('pr', 'brg', 'prd', 'stock'));
    }



    public function permintaan_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'kode' => 'required',
            'quantity' => 'required',
            'keterangan' => 'required',
            'request_by' => 'required',
            'departemen' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('barang')
                ->withErrors($validator)
                ->withInput();
        }

        $name = Barang::where('FAI_code', $request->kode)->value('name');

        $bulanRomawi = (date('m'));

        $romanNumeralMap = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $result = '';
        foreach ($romanNumeralMap as $roman => $number) {
            $matches = intval($bulanRomawi / $number);
            $result .= str_repeat($roman, $matches);
            $bulanRomawi = $bulanRomawi % $number;
        }

        $tahun = date('Y');

        $tanggalTerakhir = Permintaan::orderBy('tanggal', 'desc')->value('tanggal');

        $bulanTerakhir = date('m', strtotime($tanggalTerakhir));

        if ($bulanTerakhir != $bulanRomawi) {
            $nomorUrut = '001';
        } else {
            $jumlahData = Permintaan::whereMonth('tanggal', $bulanTerakhir)->count();

            $nomorUrut = sprintf('%03d', $jumlahData + 1);
        }

        $unicCode = "PB/FAI/{$result}/{$tahun}/{$nomorUrut}";

        $permintaan = new Permintaan([
            'tanggal' => $request->tanggal,
            'nama' => $name,
            'kode' => $request->kode,
            'LOT' => $request->LOT,
            'quantity' => $request->quantity,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'request_by' => $request->request_by,
            'departemen' => $request->departemen,
            'unic_code' => $unicCode,
        ]);
        // dd($permintaan);
        $permintaan->save();

        $lot = Stock::where('FAI_code', $request->kode)->where('no_LOT', $request->LOT)->first();
        $qty = Stock::where('FAI_code', $request->kode)->where('no_LOT', $request->LOT)->value('quantity');
        $lot->update([
            'quantity' => $qty -= $request->quantity,
        ]);

        $lot->save();

        $warehouse = Stock::where('FAI_code', $request->kode)->where('no_LOT', $request->LOT)->value('warehouse');
        $rak = RakGudang::where('id_rak', $warehouse)->first();
        $rak->kapasitas += $request->quantity;

        $rak->save();

        return redirect('permintaan');
    }

    public function getLot(Request $request)
    {
        $kode = $request->kode;
        $lots = Stock::where('FAI_code', $kode)->get(['no_LOT']);

        return response()->json($lots);
    }

    public function getStatus(Request $request)
    {
        $lot = $request->no_LOT;
        $status = QualityControl::where('LOT', $lot)->value('status');

        return response()->json(['status' => $status]);
    }

    public function getCust(Request $request)
    {
        $FAI_code = $request->FAI_code;
        $cust = CustList::where('FAI_code', $FAI_code)->get();
        return response()->json($cust);

    }

    public function getCas(Request $request)
    {
        $CAS_number = $request->CAS_number;
        $cas = PositiveList::where('CAS', $CAS_number)->get();
        return response()->json($cas);

    }
}
