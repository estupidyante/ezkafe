<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class UserOrdersComponent extends Component
{
    public function render()
    {
        $users = User::all();
        $orders = Orders::all();
        $products = Products::all();
        return view('livewire.user.user-orders-component', compact('users','orders','products'))->layout('layouts.base');
    }
}
