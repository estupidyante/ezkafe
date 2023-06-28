<?php

namespace App\Http\Livewire\User;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Livewire\Component;
use App\Models\Clients;
use App\Models\Orders;
use App\Models\Products;
use DB;

class UserGraphComponent extends Component
{
    public function render()
    {
        $users = Clients::all();
        $orders = Orders::all();
        $products = Products::all();
        
        $clients_data = Clients::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->pluck('count', 'month_name');
        $user_labels = $clients_data->keys();
        $user_data = $clients_data->values();

        return view('livewire..user.user-graph-component', 
        compact(
            'users',
            'orders',
            'products',
            
            'user_labels',
            'user_data',
        ))->layout('layouts.base');
    }
}
