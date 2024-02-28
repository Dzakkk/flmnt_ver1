<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductFormula extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'product_formula';

    protected $primaryKey = 'FAI_code';
    
    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    protected $casts = [
        'FAI_code_barang' => 'array',
        'persentase' => 'array',
    ];

    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([]);
    }
}
