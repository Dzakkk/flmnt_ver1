<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityControl extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'quality_controls';

    protected $primaryKey = 'id';

    protected $guarded = [];
}
