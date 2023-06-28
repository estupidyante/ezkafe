<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\FaqCategory;

class UserFAQsCategoryComponent extends Component
{
    public function render()
    {
        $categories = FaqCategory::all();
        return view('livewire..user.user-faqs-category-component', compact('categories'))->layout('layouts.base');
    }
}
