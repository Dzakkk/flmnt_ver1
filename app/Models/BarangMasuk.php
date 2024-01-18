<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'barang_masuk';

    protected $primaryKey = 'id_penerimaan';
    protected $guarded = [];
}
