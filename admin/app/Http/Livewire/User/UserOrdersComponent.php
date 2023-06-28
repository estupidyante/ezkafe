<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UserOrdersComponent extends LivewireDatatable
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    public $model = Orders::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('Order ID')
                ->sortBy('id')
                ->filterable(),
  
            Column::name('clients_id')
                ->label('User ID')
                ->filterable(),
  
            Column::name('products_id')
                ->label('Product')
                ->filterable(),
  
            DateColumn::name('created_at')
                ->label('Order Taken')
                ->filterable(),
            
            DateColumn::name('updated_at')
                ->label('Completed')
                ->filterable(),
        ];
    }

    public function render()
    {
        $orders = Orders::all();
        return view('livewire.user.user-orders-component', compact('orders'))->layout('layouts.base');
    }
}
