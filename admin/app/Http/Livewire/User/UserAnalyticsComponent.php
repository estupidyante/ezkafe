<?php

namespace App\Http\Livewire\User;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Livewire\Component;
use App\Models\Products;
use App\Models\ProductIngredients;
use App\Models\Ingredients;
use App\Models\Clients;
use App\Models\Orders;
use App\Models\Category;
use App\Models\Measurements;

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
        $ingredients_chart_option = [
            'chart_title' => 'Ingredients (Pie)',
            'chart_type' => 'pie',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Ingredients',
            'group_by_field' => 'name',
            'aggregate_function' => 'avg',
            'aggregate_field' => 'volume',
            'show_blank_data' => true,
        ];

        $ingredients_chart = new LaravelChart($ingredients_chart_option);
        $ingredients_bar_chart_option = [
            'chart_title' => 'Ingredients (Bar)',
            'chart_type' => 'bar',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Ingredients',
            'group_by_field' => 'name',
            'aggregate_function' => 'avg',
            'aggregate_field' => 'volume',
        ];

        $ingredients_bar_chart = new LaravelChart($ingredients_bar_chart_option);

        $transaction_chart_options = [
            'chart_title' => 'Transactions (Days)',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Orders',
            'group_by_field' => 'updated_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'avg',
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
        return view('livewire.user.user-analytics-component', 
        compact(
            'products',
            'ingredients',
            'measurements',
            'top_orders',
            'ingredients_chart',
            'ingredients_bar_chart',
            'transaction_chart',
            'revenue_chart'
            ))->layout('layouts.base');
    }
}
