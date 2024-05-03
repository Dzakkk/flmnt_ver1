<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'barang_masuk';

    protected $primaryKey = 'id_penerimaan';
    protected $guarded = [];


    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([]);
    }
    /**
     * Get all of the stockL for the BarangMasuk
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stockL(): BelongsTo
    {
        return $this->BelongsTo(Stock::class, 'no_LOT', 'no_LOT');
    }

    public function qc_check(): BelongsTo
    {
        return $this->belongsTo(QualityControl::class, 'FAI_code', 'FAI_code');
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'FAI_code', 'FAI_code');
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'FAI_code', 'FAI_code');
    }
    public function package(): BelongsTo
    {
        return $this->belongsTo(Packaging::class, 'FAI_code', 'FAI_code');
    }
}
