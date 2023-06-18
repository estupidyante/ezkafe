<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Clients;
use App\Models\Orders;


class UserListsComponent extends Component
{
    public function render()
    {
        $users = Clients::all();
        $orders = Orders::all();
        return view('livewire.user.user-lists-component', compact('users', 'orders'))->layout('layouts.base');
    }

    public function destroy($id)
    {
        //
    }
}
