<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Ingredients;
use App\Models\OrderIngredients;

class OrdersController extends Controller
{
    protected $orders;

    public function __construct(Orders $orders)
    {
        $this->orders = $orders;
    }
    public function index() {
        return response()->json(Orders::all(), 200);
    }
    public function show($id)
	{
        $orders = Orders::find($id);
	    return response()->json($orders, 200);
	}
    public function store(Request $request, Ingredients $ingredients)
    {
        $input = $request->all();
        $order = Orders::create($input);
        foreach( $ingredients->toArray() as $item => $value )
        {
            $temp_tag = str_replace(' ', '_', strtolower($item.name));
            OrderIngredients::create(
                order_id: $order.id,
                products_id: $order.products_id,
                type: $item.type,
                measurement: $item.measurement,
                actuators: $item.actuators,
                unit: $item.unit
            );
        }
        return response()->json($order, 201);
    }
    public function edit(Request $request, $id)
    {
        $order = Orders::find($id);
        $order->update($request->all());
        return response()->json($order, 201);
    }

    public function destroy($id)
    {
        try {
            $orders = Orders::find($id);
            $orders->delete();
            return redirect('/user/orders')->with('status',"Orders deleted successfully");
        }
        catch(Exception $e){
            return redirect('/user/orders')->with('failed',"Something went wrong");
        }
    }
}
