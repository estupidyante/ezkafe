<?php

namespace App\Http\Livewire\User;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Livewire\Component;
use App\Models\Products;
use App\Models\Ingredients;
use App\Models\OrderIngredients;
use App\Models\Clients;
use App\Models\Orders;
use App\Models\Category;
use App\Models\Measurements;
use DB;

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

        $clients_data = Clients::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->pluck('count', 'month_name');
        $user_labels = $clients_data->keys();
        $user_data = $clients_data->values();

        $orders_data = Orders::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->pluck('count', 'month_name');
        $order_labels = $orders_data->keys();
        $order_data = $orders_data->values();

        $revenue_data = Orders::selectRaw('sum(amount) as amount, MONTHNAME(created_at) as month_name')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->pluck('amount', 'month_name');
        $revenue_labels = $revenue_data->keys();
        $revenue_data = $revenue_data->values();
        $expense_data = OrderIngredients::selectRaw('sum(price) as amount, MONTHNAME(created_at) as month_name')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->pluck('amount', 'month_name');

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

            'user_labels',
            'user_data',

            'order_labels',
            'order_data',

            'revenue_labels',
            'revenue_data',
            'expense_data',

        ))->layout('layouts.base');
    }
}

