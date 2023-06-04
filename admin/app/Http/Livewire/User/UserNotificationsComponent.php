<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class UserNotificationsComponent extends Component
{
    public function render()
    {
        return view('livewire.user.user-notifications-component')->layout('layouts.base');
    }
}
