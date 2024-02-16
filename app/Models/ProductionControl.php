<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionControl extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'production_controls';

    protected $primaryKey = 'no_production';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

}
