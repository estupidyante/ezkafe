<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Types;

class UserTypesComponent extends Component
{
    public function render(Request $request)
    {
        $categories = Category::with('types')->get();
        $selectedTab = isset($request->id) ? $request->id : 0;
        $types = Types::all();
        return view('livewire.user.user-types-component', compact('types', 'categories', 'selectedTab'))->layout('layouts.base');
    }
}
