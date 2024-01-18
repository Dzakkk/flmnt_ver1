<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositiveList extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'positive_list';

    protected $primaryKey = 'CAS_number';
    protected $guarded = [];
}
