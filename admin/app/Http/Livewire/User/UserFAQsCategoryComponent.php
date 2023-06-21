<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\FAQsCategory;

class UserFAQsCategoryComponent extends Component
{
    public function render()
    {
        $categories = FAQsCategory::all();
        return view('livewire..user.user-faqs-category-component', compact('categories'))->layout('layouts.base');
    }
}
