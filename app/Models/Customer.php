<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $table = 'customers';

    protected $primaryKey = 'id_customer';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_customer',
        'customer_name',
        'telephone',
        'contact_name',
        'status',
        'address',
        'city',
        'provinces',
        'postal_code',
        'country',
        'email',
        'note',
        'sales_name'
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
            $latestId = static::max('id_customer');
            $newIdNumber = ($latestId) ? (int) substr($latestId, 4) + 1 : 1;
            $model->id_customer = 'CID-' . str_pad($newIdNumber, 4, '0', STR_PAD_LEFT);
        });
    }
}
