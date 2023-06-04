<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;

class UserAdminAccountsComponent extends Component
{
    public function render()
    {
        $accounts = User::all();
        return view('livewire.user.user-admin-accounts-component', compact('accounts'))->layout('layouts.base');
    }
}
