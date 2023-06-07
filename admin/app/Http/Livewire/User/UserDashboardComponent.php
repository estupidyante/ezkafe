<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Products;
use App\Models\Ingredients;
use App\Models\Clients;
use App\Models\Orders;

class UserDashboardComponent extends Component
{
    public function render() {
        $product = Products::latest()->paginate(5);
        $revenue =  Products::count();
        $ingredients = Ingredients::count();
        $orders = Orders::count();
        $users = Clients::count();
        return view('livewire.user.user-dashboard-component', compact('product', 'ingredients','revenue','orders','users'))->layout('layouts.base');
    }
}

