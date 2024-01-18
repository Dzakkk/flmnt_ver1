<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'barang_keluar';

    protected $primaryKey = 'id_pengeluaran';
    protected $guarded = [];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'FAI_code', 'FAI_code');
    }

    public function decreaseStock($requestedWeight)
    {
        $this->stock->decrement('weight', $requestedWeight);
    }
}
