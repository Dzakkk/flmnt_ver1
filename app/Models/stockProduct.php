<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class stockProduct extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'stock_product';

    protected $primaryKey = 'id_product';

    protected $guarded = [];


    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([]);
    }

    /**
     * Get all of the stockLot for the stockProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stockLot(): HasMany
    {
        return $this->hasMany(Stock::class, 'FAI_code', 'FAI_code');
    }

    /**
     * Get the Product that owns the stockProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'FAI_code', 'FAI_code');
    }

    public function qc_check(): BelongsTo
    {
        return $this->belongsTo(QualityControl::class, 'FAI_code', 'FAI_code');
    }
}
