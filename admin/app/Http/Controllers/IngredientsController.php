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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->input();
        if ($data) {
            Ingredients::create([
                'name' => $data['name'],
                'types_id' => $data['type_id'],
                'measurements_id' => $data['measurement_id'],
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
            $ingredient->types_id = $data['type_id'];
            $ingredient->measurements_id = $data['measurement_id'];
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
