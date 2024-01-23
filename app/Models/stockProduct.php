<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stockProduct extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'stock_product';

    protected $primaryKey = 'id_product';

    protected $guarded = [];
}
