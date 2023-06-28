<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Faqs;
use App\Models\FaqCategory;

class UserFAQsComponent extends Component
{
    public function render()
    {
        $categories = FaqCategory::all();
        $faqs = Faqs::all();
        return view('livewire.user.user-faqs-component', compact('faqs', 'categories'))->layout('layouts.base');
    }
}
