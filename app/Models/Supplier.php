<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Supplier extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'supplier';

    protected $primaryKey = 'id_supplier';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_supplier',
        'supplier_name',
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

    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([]);
    }

    protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        $latestId = static::max('id_supplier');
        $newIdNumber = ($latestId) ? (int) substr($latestId, 4) + 1 : 1;
        $model->id_supplier = 'SID-' . str_pad($newIdNumber, 4, '0', STR_PAD_LEFT);
    });
}
}
