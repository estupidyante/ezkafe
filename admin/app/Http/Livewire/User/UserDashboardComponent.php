<?php

namespace App\Http\Livewire\User;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Usernotnull\Toast\Concerns\WireToast;
use Livewire\Component;
use App\Models\Products;
use App\Models\Ingredients;
use App\Models\Clients;
use App\Models\Orders;
use App\Models\Category;
use App\Models\Measurements;

class UserDashboardComponent extends Component
{
    use WireToast;

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
            'chart_title' => 'Users by Months',
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
            'chart_title' => 'Transactions by Dates',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Orders',
            'group_by_field' => 'updated_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'amount',
            'chart_type' => 'line',
        ];
        $transaction_chart = new LaravelChart($transaction_chart_options);
        toast()
            ->success('You earned a cookie! 🍪')
            ->sticky()
            ->push();
        return view('livewire.user.user-dashboard-component', compact('products', 'ingredients','ingredients_count','revenue_count','orders_count','users_count', 'top_orders', 'categories', 'measurements','user_chart','transaction_chart'))->layout('layouts.base');
    }
}

