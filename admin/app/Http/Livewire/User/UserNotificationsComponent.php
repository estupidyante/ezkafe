<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Notifications;

class UserNotificationsComponent extends Component
{
    public function render()
    {
        $notifications = Notifications::all();
        return view('livewire.user.user-notifications-component', compact('notifications'))->layout('layouts.base');
    }
}
