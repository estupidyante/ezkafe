<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'name',
    ];

    public function types()
    {
        return $this->hasMany(Types::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faqs::class);
    }
}
