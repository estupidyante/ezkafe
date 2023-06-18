<?php

namespace App\Http\Livewire\User;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Livewire\Component;

class UserGraphComponent extends Component
{
    public function render()
    {
        $chart_options = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Clients',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only last 30 days
        ];

        $user_chart = new LaravelChart($chart_options);
        return view('livewire..user.user-graph-component', compact('user_chart'))->layout('layouts.base');
    }
}
