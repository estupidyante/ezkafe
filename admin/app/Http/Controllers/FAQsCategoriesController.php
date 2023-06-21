<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQsCategory;

class FAQsCategoriesController extends Controller
{
    protected $categories;

    public function __construct(FAQsCategory $categories)
    {
        $this->categories = $categories;
    }

    public function index() {
        return response()->json(FAQsCategory::all(), 200);
    }
    public function show(FAQsCategory $category)
	{
	    return $categpry;
	}
	public function store(Request $request)
	{
	    $category = FAQsCategory::create($request->all());
	    return response()->json($category, 201);
	}
	public function edit(Request $request, FAQsCategory $category)
	{
	    $category->update($request->all());
	    return response()->json($category, 200);
	}
    public function delete($id)
    {
        try {
            $category = FAQsCategory::find($id);
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
        FAQsCategory::create([
            'name' => $data['name'],
        ]);

        return redirect('/user/faqscategory')->with('status',"Category created successfully");
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();

        try {
            $category = FAQsCategory::find($id);
            $category->name = $data['name'];
            $category->update();
            return redirect('/user/faqscategory')->with('status',"Category updated successfully");
        }
        catch(Exception $e){
            return redirect('/user/faqscategory')->with('failed',"Something went wrong");
        }
    }

    public function destroy($id)
    {
        try {
            $category = FAQsCategory::find($id);
            $category->delete();
            return redirect('/user/faqscategory')->with('status',"Category deleted successfully");
        }
        catch(Exception $e){
            return redirect('/user/faqscategory')->with('failed',"Something went wrong");
        }
    }
}
