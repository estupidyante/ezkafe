<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Products;
use App\Models\Ingredients;
use App\Models\Clients;
use App\Models\Orders;
use App\Models\Category;
use App\Models\Measurements;

class UserDashboardComponent extends Component
{
    public function render() {
        $products = Products::all();
        $revenue_count =  Orders::sum('amount');
        $ingredients_count = Ingredients::count();
        $orders_count = Orders::count();
        $users_count = Clients::count();
        $ingredients = Ingredients::all();
        $categories = Category::all();
        $measurements = Measurements::all();
        $top_orders =  Orders::select('products_id')
            ->groupBy('products_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->get();
        return view('livewire.user.user-dashboard-component', compact('products', 'ingredients','ingredients_count','revenue_count','orders_count','users_count', 'top_orders', 'categories', 'measurements'))->layout('layouts.base');
    }
}

