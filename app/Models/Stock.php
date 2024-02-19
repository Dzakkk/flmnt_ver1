<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'stock_lot';

    protected $primaryKey = 'id_lot';
    protected $guarded = [];

    /**
     * Get the brgMasuk that owns the Stock
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brgMasuk(): BelongsTo
    {
        return $this->belongsTo(BarangMasuk::class, 'no_LOT', 'no_LOT');
    }

    public function brg(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'FAI_code', 'FAI_code');
    }

    // /**
    //  * Get all of the production for the Stock
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function production(): BelongsTo
    // {
    //     return $this->belongsTo(ProductionControl::class, 'no_production', 'no_production');
    // }
}
