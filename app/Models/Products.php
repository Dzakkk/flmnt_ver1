<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    
    protected $dates = ['created_at'];

    protected $table = 'products';

    protected $primaryKey = 'FAI_code';
    
    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];
}
