<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gudang extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'gudang';

    protected $primaryKey = 'id_gudang';
    protected $guarded = [];

    /**
     * Get all of the rak for the Gudang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rak(): HasMany
    {
        return $this->hasMany(RakGudang::class, 'id_gudang', 'id_gudang');
    }
}
