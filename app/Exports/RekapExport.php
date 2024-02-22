<?php

namespace App\Exports;

use App\Models\UsageData;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapExport implements FromCollection, WithHeadings
{
    protected $month;
    protected $monthNumber;

    public function __construct($month)
    {
        $this->month = $month;

        $this->monthNumber = date('m', strtotime($month));
    }

    public function collection(): SupportCollection
    {
        // Mengambil semua data penggunaan untuk bulan yang dipilih
        $usages = UsageData::whereMonth('tanggal_penggunaan', $this->monthNumber)
            ->get();

        // Inisialisasi array untuk menyimpan data penggunaan
        $monthlyUsages = [];

        // Memproses setiap data penggunaan
        foreach ($usages as $usage) {
            if (!isset($monthlyUsages[$usage->FAI_code])) {
                $monthlyUsages[$usage->FAI_code] = 0;
            }

            // Menambahkan pemakaian ke total penggunaan untuk FAI code tertentu
            $monthlyUsages[$usage->FAI_code] += $usage->pemakaian;
        }

        // Menyusun data dalam format yang sesuai dengan antarmuka FromCollection
        $formattedData = collect();
        foreach ($monthlyUsages as $FAI_code => $pemakaian) {
            $formattedData->push([
                'FAI_code' => $FAI_code,
                'pemakaian' => $pemakaian, // Menggunakan total pemakaian dari kolom total_usage
            ]);
        }
        return $formattedData;
    }

    public function headings(): array
    {
        return [
            'FAI Code',
            'Pemakaian',
        ];
    }
}
