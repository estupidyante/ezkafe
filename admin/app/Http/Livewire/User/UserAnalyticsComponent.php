<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Products;

class UserAnalyticsComponent extends Component
{
    public function render()
    {
        $products = Products::all();
        return view('livewire.user.user-analytics-component', compact('products'))->layout('layouts.base');
    }
}
