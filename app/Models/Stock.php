<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Queue\Events\Looping;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Stock extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'stock_lot';

    protected $primaryKey = 'id_lot';
    protected $guarded = [];

    public function setQuantityAttribute($value)
    {
        switch ($this->unit) {
            case 'ml':
                $this->attributes['quantity'] = $value / 1000;
                $this->attributes['unit'] = 'Liter';
                break;
            case 'gram':
                $this->attributes['quantity'] = $value / 1000;
                $this->attributes['unit'] = 'Kg';
                break;
            default:
                $this->attributes['quantity'] = $value;
        }
    }

    // // Accessor untuk menampilkan quantity sebagai kilogram
    // public function getQuantityAttribute($value)
    // {
    //     switch ($this->unit) {
    //         case 'gram':
    //             return $value; // Nilai sudah dalam kilogram
    //         case 'ml':
    //             return $value; // Nilai liter tetap
    //         default:
    //             return $value / 1000; // Konversi gram ke kilogram
    //     }
    // }


    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([]);
    }
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
