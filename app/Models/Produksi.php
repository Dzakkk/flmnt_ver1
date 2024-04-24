<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'produksi';

    protected $primaryKey = 'id';
    
    // public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];
}
