<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'barang_masuk';

    protected $primaryKey = 'id_penerimaan';
    protected $guarded = [];

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
