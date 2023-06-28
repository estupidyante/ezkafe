<?php

namespace App\Http\Livewire\User;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Livewire\Component;
use App\Models\Clients;
use App\Models\Orders;
use App\Models\Products;

class UserGraphComponent extends Component
{
    public function render()
    {
        $users = Clients::all();
        $orders = Orders::all();
        $products = Products::all();
        $chart_options = [
            'chart_title' => 'Users by Day',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Clients',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only last 30 days
        ];

        $user_chart = new LaravelChart($chart_options);
        return view('livewire..user.user-graph-component', compact('users','orders','products','user_chart'))->layout('layouts.base');
    }
}
