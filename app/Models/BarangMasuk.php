<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    public function stockL(): HasMany
    {
        return $this->hasMany(Stock::class, 'no_LOT', 'no_LOT');
    }
}
