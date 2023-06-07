<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Models\Measurements;

class UserMeasurementsComponent extends Component
{
    public function render()
    {
        $measurements = Measurements::all();
        return view('livewire.user.user-measurements-component', compact('measurements'))->layout('layouts.base');
    }
}
