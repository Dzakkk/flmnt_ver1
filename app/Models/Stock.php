<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'stock_lot';

    protected $primaryKey = 'id_lot';
    protected $guarded = [];
}
