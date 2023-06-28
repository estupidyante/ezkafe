<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'tag';

    protected $fillable = [
        'name',
    ];

    public function ingredients()
    {
        return $this->hasMany(Ingredients::class);
    }

}
