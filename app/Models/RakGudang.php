<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RakGudang extends Model
{
    use HasFactory;

    
    protected $dates = ['created_at'];

    protected $table = 'rak_gudang';

    protected $primaryKey = 'id_rak';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    /**
     * Get the gudang that owns the RakGudang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'id_gudang', 'id_gudang');
    }
    
    /**
     * Get all of the stocks for the RakGudang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class, 'id_rak', 'id_rak');
    }
}
