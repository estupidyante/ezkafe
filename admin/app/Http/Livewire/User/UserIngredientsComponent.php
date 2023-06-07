<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Models\Ingredients;
use App\Models\Types;
use App\Models\Measurements;

class UserIngredientsComponent extends Component
{
    public function render(Request $request)
    {
        $types = Types::with('ingredients')->get();
        $selectedTab = isset($request->id) ? $request->id : 0;
        $measurements = Measurements::with('ingredients')->get();
        $ingredients = Ingredients::all();
        return view('livewire.user.user-ingredients-component', compact('ingredients', 'types', 'measurements', 'selectedTab'))->layout('layouts.base');
    }
}
