<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Barang extends Model
{
    use HasFactory;

    use LogsActivity;

    protected $dates = ['created_at'];

    protected $table = 'barang';

    protected $primaryKey = 'FAI_code';
    
    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([]);
    }

    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class, 'FAI_code', 'FAI_code');
    }

    /**
     * Get all of the sb for the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sb(): HasMany
    {
        return $this->HasMany(StockBarang::class, 'FAI_code', 'FAI_code');
    }
}
