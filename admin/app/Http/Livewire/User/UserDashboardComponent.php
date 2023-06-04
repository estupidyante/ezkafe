<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Product;
use App\Models\Vending;
use App\Models\ProductsCategory;
use App\Models\User;

class UserDashboardComponent extends Component
{
    public function render() {
        $product = Product::latest()->paginate(5);
        $revenue =  Product::count();
        $ingredients = Vending::count();
        $orders = ProductsCategory::count();
        $users = User::count();
        return view('livewire.user.user-dashboard-component', compact('product', 'ingredients','revenue','orders','users'))->layout('layouts.base');
    }
}

