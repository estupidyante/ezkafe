<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Http\Request;

class UserOrdersComponent extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    public function render(Request $request)
    {
        $this->search = ($request) ? $request->input('search-date') : '';
        $products = Products::all();
        return view('livewire.user.user-orders-component', [
            'orders' => Orders::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
            'products' => $products,
        ])->layout('layouts.base');
    }
}
