<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Models\Products;
use App\Models\Category;
use App\Models\Ingredients;
use App\Models\Measurements;

class UserProductsComponent extends Component
{
    public function render(Request $request)
    {
        $categories = Category::with('products')->get();
        $selectedTab = isset($request->id) ? $request->id : 0;
        $products = Products::all();
        $ingredients = Ingredients::all();
        $measurements = Measurements::all();
        return view('livewire.user.user-products-component', compact('products', 'categories', 'selectedTab', 'ingredients', 'measurements'))->layout('layouts.base');
    }
}
