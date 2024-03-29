<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurements extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'volume',
        'unit',
        'price'
    ];

    public function ingredients()
    {
        return $this->hasMany(Ingredients::class);
    }
}
