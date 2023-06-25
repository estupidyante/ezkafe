<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    use HasFactory;

    protected $table = 'ingredients';
    
    protected $fillable = [
        'name',
        'tag',
        'types_id',
        'category_id',
        'volume',
        'max_volume',
    ];

    public function ingredients(): HasManyThrough
    {
        return $this->hasManyThrough(Types::class, Measurements::class);
    }

}
