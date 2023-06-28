<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Models\Types;

class UserTypesComponent extends Component
{
    public function render(Request $request)
    {
        $types = Types::all();
        return view('livewire.user.user-types-component', compact('types'))->layout('layouts.base');
    }
}
