<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public function ingredients()
    {
        return $this->hasMany(Ingredients::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faqs::class);
    }
}
