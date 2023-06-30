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
    public function sortGraphBy($sortType, $sortDate) {
        $sqlClientStatement = DB::raw("MONTHNAME(created_at) as month_name");
        $sqlOrderStatement = DB::raw("MONTHNAME(created_at) as month_name");
        $sqlSaleStatement = 'sum(amount) as amount, MONTHNAME(created_at) as month_name';
        $sqlExpenseStatement = 'sum(price * measurement) as amount, MONTHNAME(created_at) as month_name';

        if($sortDate == 'year') {
            if($sortType == 'revenue') {
                $sqlSaleStatement = 'sum(amount) as amount, YEAR(created_at) as month_name';
                $sqlExpenseStatement = 'sum(price * measurement) as amount, YEAR(created_at) as month_name';
            } else if ($sortType == 'user') {
                $sqlClientStatement = DB::raw("YEAR(created_at) as month_name");
            } else if ($sortType == 'order') {
                $sqlOrderStatement = DB::raw("YEAR(created_at) as month_name");
            }
        } else if ($sortDate == 'day') {
            if($sortType == 'revenue') {
                $sqlSaleStatement = 'sum(amount) as amount, DAY(created_at) as month_name';
                $sqlExpenseStatement = 'sum(price * measurement) as amount, DAY(created_at) as month_name';
            } else if ($sortType == 'user') {
                $sqlClientStatement = DB::raw("DAY(created_at) as month_name");
            } else if ($sortType == 'order') {
                $sqlOrderStatement = DB::raw("DAY(created_at) as month_name");
            }
        } else {
            if($sortType == 'revenue') {
                $sqlSaleStatement = 'sum(amount) as amount, MONTHNAME(created_at) as month_name';
                $sqlExpenseStatement = 'sum(price * measurement) as amount, MONTHNAME(created_at) as month_name';
            } else if ($sortType == 'user') {
                $sqlClientStatement = DB::raw("MONTHNAME(created_at) as month_name");
            } else if ($sortType == 'order') {
                $sqlOrderStatement = DB::raw("MONTHNAME(created_at) as month_name");
            }
        }

        $clients_data = Clients::select(DB::raw("COUNT(*) as count"), $sqlClientStatement)
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->pluck('count', 'month_name');

        if(sizeof($clients_data)) {
            $user_labels = $clients_data->keys();
            $user_data = $clients_data->values();

            $orders_data = Orders::select(DB::raw("COUNT(*) as count"), $sqlOrderStatement)
                ->whereYear('created_at', date('Y'))
                ->where('status', 'completed')
                ->groupBy('month_name')
                ->pluck('count', 'month_name');
            $order_labels = $orders_data->keys();
            $order_data = $orders_data->values();

            $sales_data = Orders::selectRaw($sqlSaleStatement)
                ->whereYear('created_at', date('Y'))
                ->where('status', 'completed')
                ->groupBy('month_name')
                ->pluck('amount', 'month_name');
            $sale_labels = $sales_data->keys();
            $sale_data = $sales_data->values();
            $expense_data = OrderIngredients::selectRaw($sqlExpenseStatement)
                ->whereYear('created_at', date('Y'))
                ->groupBy('month_name')
                ->pluck('amount', 'month_name');

            if ($sortType == 'revenue') {
                return response()->json([
                    'sale_labels' => $sale_labels,
                    'sale_data' => $sale_data,
                    'expense_data' => $expense_data,
                ], 200);
            } else if ($sortType == 'user') {
                return response()->json([
                    'user_labels' => $user_labels,
                    'user_data' => $user_data,
                ], 200);
            } else if ($sortType == 'order') {
                return response()->json([
                    'order_labels' => $order_labels,
                    'order_data' => $order_data,
                ], 200);
            }
        } else {
            return response()->json([], 404);
        }
    }

    public function render() {
        $products = Products::all();
        $revenue_count =  Orders::where('status', 'completed')->sum('amount');
        $ingredients_count = Ingredients::count();
        $orders_count = Orders::where('status', 'completed')->count();
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

            'sale_labels',
            'sale_data',
            'expense_data',

        ))->layout('layouts.base');
    }
}

