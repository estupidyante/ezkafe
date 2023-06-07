<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Faqs;
use App\Models\Category;

class UserFAQsComponent extends Component
{
    public function render()
    {
        $categories = Category::all();
        $faqs = Faqs::all();
        return view('livewire.user.user-faqs-component', compact('faqs', 'categories'))->layout('layouts.base');
    }
}
