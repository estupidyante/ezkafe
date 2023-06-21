<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQsCategory extends Model
{
    use HasFactory;

    protected $table = 'faq_category';

    protected $fillable = [
        'name',
    ];

    public function faqs()
    {
        return $this->hasMany(Faqs::class);
    }

}
