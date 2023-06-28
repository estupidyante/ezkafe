<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Clients;
use App\Models\Orders;
use App\Models\CustomOrder;


class UserListsComponent extends Component
{
    public function render()
    {
        $users = Clients::all();
        $orders = Orders::all();
        $custom_orders = CustomOrder::all();
        return view('livewire.user.user-lists-component', compact('users', 'orders', 'custom_orders'))->layout('layouts.base');
    }

    public function destroy($id)
    {
        //
    }
}
