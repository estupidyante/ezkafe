<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'types';

    protected $fillable = [
        'name',
    ];

    public function ingredients()
    {
        return $this->hasMany(Ingredients::class);
    }

    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
