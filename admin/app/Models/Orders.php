<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';
    
    protected $fillable = [
        'clients_id',
        'products_id',
        'amount',
        'status'
    ];

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('id', 'like', '%'.$search.'%')
                ->orWhere('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%');
    }

    public function clients()
    {
        return $this->hasMany(Clients::class);
    }

    public function ingredients()
    {
        return $this->hasMany(OrderIngredients::class);
    }
}
