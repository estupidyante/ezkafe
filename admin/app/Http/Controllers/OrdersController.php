<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Ingredients;
use App\Models\ProductIngredients;
use App\Models\OrderIngredients;
use App\Models\CustomOrder;
use App\Models\Clients;
use App\Models\Notifications;
use DB;

class OrdersController extends Controller
{
    protected $orders;

    public function __construct(Orders $orders)
    {
        $this->orders = $orders;
    }
    public function index() {
        return response()->json(['status' => 'success','code' => 200, 'message' => Orders::with('ingredients')->get()], 200);
    }
    public function show($id)
	{
        $orders = Orders::with('ingredients')->find($id)->get();
	    return response()->json(['status' => 'success','code' => 200, 'message' => $orders], 200);
	}
    public function store(Request $request)
    {
        $input = $request[0];
        $product = $request[1];
        $order = Orders::create($input);

        $arrayIng = $product['ingredients'];
        $customOrderIngredients = [
            'name' => $product['name'],
            'price' => $product['price'],
            'coffee_qty' => 0,
            'milk_qty' => 0,
            'soya_qty' => 0,
            'classic_qty' => 0,
            'brownSugar_qty' => 0,
            'whiteSugar_qty' => 0,
            'cocoa_qty' => 0,
            'creamer_qty' => 0,
            'frenchVanilla_qty' => 0,
            'hazelnut_qty' => 0,
            'butterscotch_qty' => 0,
            'caramel_qty' => 0,
            'chocolate_qty' => 0,
        ];
        for($i = 0;$i<sizeof($arrayIng);$i++)
        {
            OrderIngredients::create([
                'name' => $arrayIng[$i]['name'],
                'tag' => $arrayIng[$i]['tag'],
                'order_id' => $order['id'],
                'types_id' => $arrayIng[$i]['types_id'],
                'category_id' => $arrayIng[$i]['category_id'],
                'measurements_id' => $arrayIng[$i]['measurements_id'],
                'measurement' => $arrayIng[$i]['measurement'],
                'unit' => $arrayIng[$i]['unit'],
                'price' => $arrayIng[$i]['price'],
                'volume' => $arrayIng[$i]['volume'],
            ]);

            // assemble ingredients
            $customOrderIngredients[$arrayIng[$i]['tag']] = $arrayIng[$i]['measurement'];
        }

        $customOrdered = CustomOrder::create($customOrderIngredients);
        $user = Clients::find($order->clients_id);
        flash()->success('User'. $user->id .' placed an order successfully')->flash();
        Notifications::create([
            'type' => 'order',
            'content' => 'User'. $user->id .' placed an order successfully',
        ]);
        return response()->json(['status' => 'success','code' => 201, 'message' => $customOrdered], 201);
    }
    public function getCustomOrder($id)
    {
        $custom_orders = CustomOrder::find($id)->get();
	    return response()->json(['status' => 'success','code' => 200, 'message' => $custom_orders], 200);
    }
    public function edit(Request $request, $id)
    {
        $order = Orders::find($id);
        $order->update($request->all());
        return response()->json(['status' => 'success','code' => 200, 'message' => $order], 201);
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
