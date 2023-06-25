<?php

namespace App\Http\Livewire\Datatable;

use Livewire\Component;
use App\Models\Orders;
use App\Models\Clients;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class OrderDatatables extends LivewireDatatable
{
    public $model = Orders::class;

    public function builder()
    {
        return Orders::query()->leftJoin('user', 'clients.id', 'orders.clients_id');
    }

    public function columns()
    {
        return [
            Column::checkbox(),

            NumberColumn::name('id')
                ->label('ID')
                ->filterable()
                ->linkTo('user', 6),

            Column::name('clients.name')
                ->label('Clients')
                ->filterable($this->clients)->alignRight(),
        ];
    }
}
