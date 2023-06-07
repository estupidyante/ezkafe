<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Category;

class UserCategoriesComponent extends Component
{
    public function render()
    {
        $categories = Category::all();
        return view('livewire.user.user-categories-component', compact('categories'))->layout('layouts.base');
    }
}
