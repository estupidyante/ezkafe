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
        'types_id',
        'measurements_id',
        'volume',
    ];

    public function ingredients(): HasManyThrough
    {
        return $this->hasManyThrough(Types::class, Measurements::class);
    }

}
