<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Clients;

class UserListsComponent extends Component
{
    public function render()
    {
        $users = Clients::all();
        return view('livewire.user.user-lists-component', compact('users'))->layout('layouts.base');
    }

    public function destroy($id)
    {
        //
    }
}
