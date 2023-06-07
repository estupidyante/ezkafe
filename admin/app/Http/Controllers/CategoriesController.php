<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    protected $categories;

    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->input();
        Category::create([
            'name' => $data['name'],
        ]);

        return redirect('/user/categories')->with('status',"Category created successfully");
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();

        try {
            $category = Category::find($id);
            $category->name = $data['name'];
            $category->update();
            return redirect('/user/categories')->with('status',"Category updated successfully");
        }
        catch(Exception $e){
            return redirect('/user/categories')->with('failed',"Something went wrong");
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            $category->delete();
            return redirect('/user/categories')->with('status',"Category deleted successfully");
        }
        catch(Exception $e){
            return redirect('/user/categories')->with('failed',"Something went wrong");
        }
    }
}
