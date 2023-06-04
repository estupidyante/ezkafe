<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class UserAnalyticsComponent extends Component
{
    public function render()
    {
        return view('livewire.user.user-analytics-component')->layout('layouts.base');
    }
}
