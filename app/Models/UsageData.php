<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsageData extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'usage_data';

    protected $primaryKey = 'id';

    protected $guarded = [];
}
