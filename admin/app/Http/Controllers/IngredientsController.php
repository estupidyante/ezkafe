<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredients;
use App\Models\Types;

class IngredientsController extends Controller
{
    protected $ingredients;

    public function __construct(Ingredients $ingredients)
    {
        $this->ingredients = $ingredients;
    }
    public function index() {
        return response()->json(Ingredients::all(), 200);
    }
    public function show($id)
	{
        $ingredient = Ingredients::find($id);
	    return response()->json($ingredient, 200);
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name'              => 'required|min:1|max:64',
            'type_id'           => 'required',
            'measurement_id'    => 'required',
            'actuator'          => 'required',
            'volume'            => 'required'
        ]);

        $data = $request->input();
        if ($data) {
            $temp_tag = str_replace(' ', '_', strtolower($data['name']));
            Ingredients::create([
                'name' => $data['name'],
                'tag' => $temp_tag,
                'types_id' => $data['type_id'],
                'measurements_id' => $data['measurement_id'],
                'actuators' => $data['actuator'],
                'volume' => $data['volume'],
                
            ]);

            return redirect('/user/ingredients')->with('status',"Ingredient created successfully");
        } else {
            return redirect('/user/ingredients')->with('failed',"Something went wrong");
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();

        try {
            $ingredient = Ingredients::find($id);
            $ingredient->name = $data['name'];
            $ingredient->tag = str_replace(' ', '_', strtolower($data['name']));
            $ingredient->types_id = $data['type_id'];
            $ingredient->measurements_id = $data['measurement_id'];
            $ingredient->actuators = $data['actuator'];
            $ingredient->volume = $data['volume'];
            $ingredient->update();
            return redirect('/user/ingredients')->with('status',"Ingredients updated successfully");
        }
        catch(Exception $e){
            return redirect('/user/ingredients')->with('failed',"Something went wrong");
        }
    }

    public function destroy($id)
    {
        try {
            $ingredient = Ingredients::find($id);
            $ingredient->delete();
            return redirect('/user/ingredients')->with('status',"Ingredient deleted successfully");
        }
        catch(Exception $e){
            return redirect('/user/ingredients')->with('failed',"Something went wrong");
        }
    }
}
