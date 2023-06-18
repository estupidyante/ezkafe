<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderIngredients extends Model
{
    use HasFactory;

    protected $table = 'order_ingredients';

    protected $fillable = [
        'name',
        'tag',
        'products_id',
        'types_id',
        'measurements_id',
        'measurement',
        'actuators',
        'unit',
        'price',
        'volume',
    ];

    public function order_ingredients()
    {
        return $this->belongsTo(Orders::class);
    }

}