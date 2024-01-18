<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'manufacturer';

    protected $primaryKey = 'id_manufacturer';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_manufacturer',
        'manufacturer_name',
        'telephone',
        'contact_name',
        'status',
        'address',
        'city',
        'provinces',
        'postal_code',
        'country',
        'email',
        'note'
    ];

    protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        $latestId = static::max('id_manufacturer');
        $newIdNumber = ($latestId) ? (int) substr($latestId, 4) + 1 : 1;
        $model->id_manufacturer = 'MID-' . str_pad($newIdNumber, 4, '0', STR_PAD_LEFT);
    });
}
}
