<?php

namespace App\Models\Helpers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\returnSelf;

class UnitConverter extends Model
{
    use HasFactory;

    public static function toGram($quantity, $unit)
    {
        switch ($unit) {
            case 'Kg':
                return $quantity * 1000;
                break;
            case 'gram':
                return $quantity;
                break;
            case 'liter':
                return $quantity * 1000;
                break;
            case 'ml':
                return $quantity;
                break;
            case 'Pcs':
                return $quantity;
                break;
            default:
                return $quantity;
                break;
        }
    }

    public static function toKilo($quantity, $unit)
    {
        switch ($unit) {
            case 'Kg':
                return $quantity;
                break;
            case 'gram':
                return $quantity / 1000;
                break;
            case 'liter':
                return $quantity;
                break;
            case 'ml':
                return $quantity / 1000;
                break;
            default:
                return $quantity;
                break;
        }
    }
}
