<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    use HasFactory;

    protected $table = 'ingredients';
    
    protected $fillable = [
        'id',
        'name',
        'categories_id',
        'amount',
        'srp'
    ];

    public function ingredients()
    {
        return $this->belongsTo(Category::class);
    }
}
