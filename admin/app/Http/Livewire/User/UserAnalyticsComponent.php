<?php

namespace App\Http\Livewire\User;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Livewire\Component;
use App\Models\Products;
use App\Models\ProductIngredients;
use App\Models\OrderIngredients;
use App\Models\Ingredients;
use App\Models\Clients;
use App\Models\Orders;
use App\Models\Category;
use App\Models\Measurements;
use DB;

class UserAnalyticsComponent extends Component
{
    public function render()
    {
        $products = Products::all();
        $ingredients = Ingredients::all();
        $measurements = Measurements::all();
        $top_orders =  Orders::select('products_id')
            ->groupBy('products_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->get();

        $ingredient_all_data = Ingredients::selectRaw('id, name, sum(volume) as volume')
            ->groupBy('id')
            ->whereYear('created_at', date('Y'))
            ->pluck('volume','name');
        $ingredient_all_labels = $ingredient_all_data->keys();
        $ingredient__all_data = $ingredient_all_data->values();

        $orders_data = Orders::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->where('status', 'completed')
            ->groupBy('month_name')
            ->pluck('count', 'month_name');
        $order_labels = $orders_data->keys();
        $order_data = $orders_data->values();

        $sales_data = Orders::selectRaw('sum(amount) as amount, MONTHNAME(created_at) as month_name')
            ->whereYear('created_at', date('Y'))
            ->where('status', 'completed')
            ->groupBy('month_name')
            ->pluck('amount', 'month_name');
        $sale_labels = $sales_data->keys();
        $sale_data = $sales_data->values();
        $expense_data = OrderIngredients::selectRaw('sum(price * measurement) as amount, MONTHNAME(created_at) as month_name')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->pluck('amount', 'month_name');
        return view('livewire.user.user-analytics-component', 
        compact(
            'products',
            'ingredients',
            'measurements',
            'top_orders',

            'ingredient_all_labels',
            'ingredient_all_data',

            'order_labels',
            'order_data',

            'sale_labels',
            'sale_data',
            'expense_data',
        ))->layout('layouts.base');
    }
}
