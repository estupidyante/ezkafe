<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Notifications;

class UserNotificationsComponent extends Component
{

    public function render()
    {
        $notifications = Notifications::orderBy('created_at','desc')->get();
        return view('livewire.user.user-notifications-component', compact('notifications'))->layout('layouts.base');
    }
}
