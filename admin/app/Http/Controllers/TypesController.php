<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Types;

class TypesController extends Controller
{
    protected $types;

    public function __construct(Types $types)
    {
        $this->types = $types;
    }
    public function index() {
        return response()->json(Types::with('ingredients')->get(), 200);
    }
    public function show($id)
	{
        $type = Types::find($id);
	    return response()->json($type, 200);
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->input();
        Types::create([
            'name' => $data['name']
        ]);

        return redirect('/user/types')->with('status',"Type created successfully");
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();

        try {
            $type = Types::find($id);
            $type->name = $data['name'];
            $type->update();
            return redirect('/user/types')->with('status',"Type updated successfully");
        }
        catch(Exception $e){
            return redirect('/user/types')->with('failed',"Something went wrong");
        }
    }

    public function destroy($id)
    {
        try {
            $type = Types::find($id);
            $type->delete();
            return redirect('/user/types')->with('status',"Type deleted successfully");
        }
        catch(Exception $e){
            return redirect('/user/types')->with('failed',"Something went wrong");
        }
    }
}
