<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'barang';

    protected $primaryKey = 'FAI_code';
    
    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];
}
