<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Products extends Model
{
    use HasFactory;

    
    protected $dates = ['created_at'];

    protected $table = 'products';

    protected $primaryKey = 'FAI_code';
    
    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];


    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([]);
    }

    /**
     * Get the user that owns the Products
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formula(): BelongsTo
    {
        return $this->belongsTo(ProductFormula::class, 'FAI_code', 'FAI_code');
    }

}
