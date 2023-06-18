<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Products;
use App\Models\Ingredients;
use App\Models\Clients;
use App\Models\Orders;
use App\Models\Category;
use App\Models\Measurements;

class UserAnalyticsComponent extends Component
{
    public function render()
    {
        $products = Products::all();
        $ingredients = Ingredients::all();
        $measurements = Measurements::all();
        $top_orders =  Orders::select('products_id')
            ->groupBy('products_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->get();
        return view('livewire.user.user-analytics-component', compact('products','ingredients','measurements','top_orders'))->layout('layouts.base');
    }
}
