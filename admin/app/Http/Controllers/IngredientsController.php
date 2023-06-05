<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredients;
use App\Models\Categories;

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
        Ingredients::create([
            'name' => $data['name'],
            'amount' => $data['amount'],
            'srp' => $data['amount'],
            'categories_id' => $data['category_id']
        ]);

        return redirect('/user/ingredients')->with('status',"Ingredient created successfully");
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();

        try {
            $ingredient = Ingredients::find($id);
            $ingredient->name = $data['name'];
            $ingredient->amount = $data['amount'];
            $ingredient->srp = $data['amount'];
            $ingredient->categories_id = $data['category_id'];
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
