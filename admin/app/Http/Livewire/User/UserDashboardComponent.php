<?php

namespace App\Http\Livewire\User;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Livewire\Component;
use App\Models\Products;
use App\Models\Ingredients;
use App\Models\Clients;
use App\Models\Orders;
use App\Models\Category;
use App\Models\Measurements;

class UserDashboardComponent extends Component
{

    public function render() {
        $products = Products::all();
        $revenue_count =  Orders::sum('amount');
        $ingredients_count = Ingredients::count();
        $orders_count = Orders::count();
        $users_count = Clients::count();
        $ingredients = Ingredients::all();
        $categories = Category::all();
        $measurements = Measurements::all();
        $top_orders =  Orders::select('products_id')
            ->groupBy('products_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->get();

        $user_chart_options = [
            'chart_title' => 'Users (Months)',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Clients',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only last 30 days
        ];

        $user_chart = new LaravelChart($user_chart_options);

        $transaction_chart_options = [
            'chart_title' => 'Transactions (Months)',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Orders',
            'group_by_field' => 'updated_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'amount',
            'chart_type' => 'line',
        ];
        $transaction_chart = new LaravelChart($transaction_chart_options);

        $revenue_chart_settings_1 = [
            'chart_title'           => 'Revenue',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\OrderIngredients',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_field'       => 'price',
            'aggregate_function'    => 'avg',
            'filter_field'          => 'created_at',
            'filter_days'           => '30',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'revenue',
            'continuous_time'       => true,
        ];

        $revenue_chart_settings_2 = [
            'chart_title'           => 'Sales',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\OrderIngredients',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_field'       => 'price',
            'aggregate_function'    => 'sum',
            'filter_field'          => 'created_at',
            'filter_days'           => '30',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'sales',
            'continuous_time'       => true,
        ];
        $revenue_chart = new LaravelChart($revenue_chart_settings_1, $revenue_chart_settings_2);
        // flash()->success('Notification placeholder')->flash();
        return view('livewire.user.user-dashboard-component', 
        compact(
            'products', 
            'ingredients',
            'ingredients_count',
            'revenue_count',
            'orders_count',
            'users_count', 
            'top_orders', 
            'categories', 
            'measurements',
            'user_chart',
            'transaction_chart',
            'revenue_chart'
        ))->layout('layouts.base');
    }
}

