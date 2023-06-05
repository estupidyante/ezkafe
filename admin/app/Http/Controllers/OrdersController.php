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

    public function create(Request $request)
    {
        //
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
