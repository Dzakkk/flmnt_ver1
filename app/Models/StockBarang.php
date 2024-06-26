<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class StockBarang extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'stock_barang';

    protected $primaryKey = 'FAI_code';

    public $incrementing = false;

    protected $guarded = [];

    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([]);
    }

    /**
     * Get all of the sb for the StockBarang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barang(): BelongsTo
    {
        return $this->BelongsTo(Barang::class, 'FAI_code', 'FAI_code');
    }

    public function stockLots()
    {
        return $this->hasMany(Stock::class, 'FAI_code', 'FAI_code');
    }

}
