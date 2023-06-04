<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class UserFAQsComponent extends Component
{
    public function render()
    {
        return view('livewire.user.user-faqs-component')->layout('layouts.base');
    }
}
