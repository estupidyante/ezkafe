<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOrder extends Model
{
    use HasFactory;

    protected $table = 'custom_order';

    protected $fillable = [
        'coffee_qty',
        'milk_qty',
        'soya_qty',
        'classic_qty',
        'brownSugar_qty',
        'whiteSugar_qty',
        'cocoa_qty',
        'creamer_qty',
        'frenchVanilla_qty',
        'hazelnut_qty',
        'butterscotch_qty',
        'caramel_qty',
        'chocolate_qty',
    ];

}
