<?php

namespace App\Http\Livewire\User;

use Usernotnull\Toast\Concerns\WireToast;
use Livewire\Component;
use App\Models\Notifications;

class UserNotificationsComponent extends Component
{
    use WireToast;

    public function render()
    {
        $notifications = Notifications::orderBy('created_at','desc')->get();
        toast()
            ->success('You earned a cookie! 🍪')
            ->sticky()
            ->push();
        return view('livewire.user.user-notifications-component', compact('notifications'))->layout('layouts.base');
    }
}
