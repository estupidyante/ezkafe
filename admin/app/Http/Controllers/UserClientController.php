<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;

class UserClientController extends Controller
{
    
    protected $clients;

    public function __construct(Clients $clients)
    {
        $this->clients = $clients;
    }
    public function index() {
        return response()->json(Clients::all(), 200);
    }
    public function show($id)
	{
        $client = Clients::find($id);
	    return response()->json($client, 200);
	}
    public function store(Request $request)
	{
        $input = $request->all();
	    $client = Clients::create($input);
	    return response()->json($client, 201);
	}
    public function update(Request $request, $id)
    {
        $client = Clients::find($id);
        $client->name = $request->name;
        $client->save();
        session()->flash('status', 'Client has been update !!');
        return back();
    }

    public function destroy(Clients $user)
    {
        $user->delete();

        session()->flash('status', 'Admin has been deleted !!');
        return back();
    }

}
