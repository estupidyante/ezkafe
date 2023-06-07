<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Products;

class UserProductsComponent extends Component
{
    public function render()
    {
        $products = Products::all();
        return view('livewire.user.user-products-component', compact('products'))->layout('layouts.base');
    }
}
