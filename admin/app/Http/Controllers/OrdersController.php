<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;

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
    public function store(Request $request)
    {
        $input = $request->all();
        $order = Orders::create($input);
        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        //
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
