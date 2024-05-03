<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKemasan extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'jenis_kemasan';

    protected $guarded = [];
}
