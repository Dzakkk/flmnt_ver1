<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockBarang extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'stock_barang';

    protected $primaryKey = 'FAI_code';

    public $incrementing = false;

    protected $guarded = [];
}
