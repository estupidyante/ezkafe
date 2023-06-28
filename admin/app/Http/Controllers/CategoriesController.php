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

    public function index() {
        return response()->json(Category::all(), 200);
    }
    public function show(Category $category)
	{
	    return $categpry;
	}
	public function store(Request $request)
	{
	    $category = Category::create($request->all());
	    return response()->json($category, 201);
	}
	public function edit(Request $request, Category $category)
	{
	    $category->update($request->all());
	    return response()->json($category, 200);
	}
    public function delete($id)
    {
        try {
            $category = Category::find($id);
            if($category) {
                $category->delete();
                return response()->json($category, 204);
            } else {
                return response()->json([], 404);
            }
        }
        catch(Exception $e){
            return response()->json([], 404);
        }
    }
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
