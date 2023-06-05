<?php

namespace App\Http\Controllers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AccountsController extends Controller
{
    
    protected $users;
 
    /**
     * Create a new controller instance.
     *
     * @param  \App\Models\User  $users
     * @return void
     */
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function show(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $admin = User::find($id);

        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        return back();
    }

    public function edit(Request $request, $id)
    {
        //
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

        return redirect()->route('user.accounts');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.accounts');
    }

}
