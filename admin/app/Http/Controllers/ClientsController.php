<?php

namespace App\Http\Controllers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ClientsContoller extends Controller
{
    
    protected $clients;
    /**
     * admin can update the clients order.
     */
 
    public function __construct(Clients $clients)
    {
        $this->clients = $clients;
    }

    public function update(Request $request, $id)
    {
        $client = Clients::find($id);
        $client->username = $request->username;
        $client->save();
        session()->flash('status', 'Client has been update !!');
        return back();
    }

    public function create(Request $request)
    {
        $data = $request->input();

        User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        session()->flash('status', 'Admin has been created !!');
        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('status', 'Admin has been deleted !!');
        return back();
    }

}
