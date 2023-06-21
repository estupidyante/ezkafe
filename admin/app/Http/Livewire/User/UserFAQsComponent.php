<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Faqs;
use App\Models\FAQsCategory;

class UserFAQsComponent extends Component
{
    public function render()
    {
        $categories = FAQsCategory::all();
        $faqs = Faqs::all();
        return view('livewire.user.user-faqs-component', compact('faqs', 'categories'))->layout('layouts.base');
    }
}
