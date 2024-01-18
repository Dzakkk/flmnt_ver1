<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFormula extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'product_formula';

    protected $primaryKey = 'FAI_code';
    
    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];
}
