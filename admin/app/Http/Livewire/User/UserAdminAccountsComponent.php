<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserAdminAccountsComponent extends Component
{
    public function render()
    {
        $you = Auth::user();
        $accounts = User::all();
        return view('livewire.user.user-admin-accounts-component', compact('accounts', 'you'))->layout('layouts.base');
    }
}
