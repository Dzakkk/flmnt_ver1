<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductionControl extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'production_controls';

    protected $primaryKey = 'no_production';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];


    /**
     * Get the stockl that owns the ProductionControl
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stockl()
    {
        return $this->belongsTo(Stock::class, 'no_production', 'no_production');
    }

    public function cust()
    {
        return $this->belongsTo(CustList::class, 'FAI_code', 'FAI_code');
    }
}
