<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'barang_keluar';

    protected $primaryKey = 'id_pengeluaran';
    protected $guarded = [];


    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([]);
    }


    public function stock()
    {
        return $this->belongsTo(Stock::class, 'FAI_code', 'FAI_code');
    }

    public function decreaseStock($requestedWeight)
    {
        $this->stock->decrement('weight', $requestedWeight);
    }
}
