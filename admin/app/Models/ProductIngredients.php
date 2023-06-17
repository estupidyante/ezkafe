<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductIngredients extends Model
{
    use HasFactory;

    protected $table = 'product_ingredients';

    protected $fillable = [
        'name',
        'tag',
        'products_id',
        'types_id',
        'measurements_id',
        'measurement',
        'unit',
        'price',
        'volume',
    ];

}
