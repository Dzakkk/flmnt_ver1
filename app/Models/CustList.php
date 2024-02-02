<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustList extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'cust_list';

    protected $primaryKey = 'id';
    protected $guarded = [];
}
