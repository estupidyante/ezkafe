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

    public function faqs()
    {
        return $this->hasMany(Faqs::class);
    }

    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
