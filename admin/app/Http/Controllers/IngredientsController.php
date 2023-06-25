<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductIngredients;
use App\Models\Ingredients;
use App\Models\Notifications;
use App\Models\Types;

class IngredientsController extends Controller
{
    protected $ingredients;

    public function __construct(Ingredients $ingredients)
    {
        $this->ingredients = $ingredients;
    }
    public function index() {
        return response()->json(['status' => 'success','code' => 200, 'message' => Ingredients::all()], 200);
    }
    public function show($id)
	{
        $ingredient = Ingredients::find($id);
	    return response()->json(['status' => 'success','code' => 200, 'message' => $ingredient], 200);
	}
    public function getSpecificIngredients($id)
	{
        $ingredient = ProductIngredients::where('id', $id)->get();
	    return response()->json(['status' => 'success','code' => 200, 'message' => $ingredient], 200);
	}
    public function edit(Request $request, $id)
	{
        $ingredient = ProductIngredients::find($id)->update([
            'price' => $request->price,
            'volume' => $request->volume
        ]);
        $updatedIng = ProductIngredients::find($id);
        flash()->success($updatedIng->name . ' has only '. $updatedIng->volume . ' remaining!', 'Ingredients')->flash();
        toast()
            ->success($updatedIng->name . ' has only '. $updatedIng->volume . ' remaining!', 'Ingredients')
            ->pushOnNextPage();
        Notifications::create([
            'type' => 'ingredients',
            'content' => $updatedIng->name . ' has only '. $updatedIng->volume . ' remaining!',
        ]);
	    return response()->json(['status' => 'success','code' => 201, 'message'=> $updatedIng->name . ' Updated Successfully! has only '. $updatedIng->volume . ' remaining!'], 201);
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
            'category_id'       => 'required',
            'tag'               => 'required',
            'volume'            => 'required'
        ]);

        $data = $request->input();
        if ($data) {
            Ingredients::create([
                'name' => $data['name'],
                'tag' => $data['tag'],
                'types_id' => $data['type_id'],
                'category_id' => $data['category_id'],
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
            $ingredient->tag = $data['tag'];
            $ingredient->types_id = $data['type_id'];
            $ingredient->category_id = $data['category_id'];
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
