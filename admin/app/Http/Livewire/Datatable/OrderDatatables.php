<?php

namespace App\Http\Livewire\Datatable;

use Livewire\Component;
use App\Models\Orders;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class OrderDatatables extends LivewireDatatable
{
    public $model = Orders::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('Order ID')
                ->sortBy('id'),
  
            Column::name('clients_id')
                ->label('User ID'),
  
            Column::name('products_id')
                ->label('Product'),
  
            DateColumn::name('created_at')
                ->label('Creation Date')
        ];
    }
}
