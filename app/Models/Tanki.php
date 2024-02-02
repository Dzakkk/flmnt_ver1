<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanki extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'tanki';

    protected $primaryKey = 'id_tanki';
    protected $guarded = [];
}
