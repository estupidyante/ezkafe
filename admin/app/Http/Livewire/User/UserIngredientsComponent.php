<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Models\Ingredients;
use App\Models\Categories;

class UserIngredientsComponent extends Component
{
    public function render(Request $request)
    {
        $categories = Categories::with('ingredients')->get();
        $catTab = isset($request->id) ? $request->id : 0;
        $ingredients = Ingredients::all();
        return view('livewire.user.user-ingredients-component', compact('ingredients', 'categories', 'catTab'))->layout('layouts.base');
    }
}
