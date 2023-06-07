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
        'volume',
        'price',
        'types_id',
    ];

    public function ingredients()
    {
        return $this->belongsTo(Types::class);
    }
}
