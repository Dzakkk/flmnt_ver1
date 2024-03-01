<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $dates = ['created_date'];
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
