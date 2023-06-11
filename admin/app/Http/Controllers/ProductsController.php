<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Types;

class ProductsController extends Controller
{
    protected $products;

    public function __construct(Products $products)
    {
        $this->products = $products;
    }

    public function index() {
        return response()->json(Products::all(), 200);
    }
    public function show(Product $product)
	{
	    return $product;
	}
	public function store(Request $request)
	{
	    $product = Products::create($request->all());
	    return response()->json($product, 201);
	}
	public function edit(Request $request, Products $product)
	{
	    $product->update($request->all());
	    return response()->json($product, 200);
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name'             => 'required|min:1|max:64',
            'category_id'      => 'required',
            'ing'              => 'required'
        ]);

        $products = new Products();
        $products->name        = $request->input('name');
        $products->description = $request->input('description');
        $products->price       = $request->input('price');
        $products->category_id = $request->input('category_id');
        $products->ing_ids     = implode(',', $request->input('ing'));
        if($request->file('uploads')){
            $file       = $request->file('uploads');
            $fileName   = $file->getClientOriginalName();
            $destinationPath = public_path().'/assets/images/uploads';
            $file->move($destinationPath,$fileName);
            $products->image = '/assets/images/uploads/'.$fileName;
        }
        $products->save();
        return redirect('/user/products')->with('status',"Product created successfully");
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();

        try {
            $products = Products::find($id);
            $products->name        = $request->input('name');
            $products->description = $request->input('description');
            $products->price       = $request->input('price');
            $products->category_id = $request->input('category_id');
            $products->ing_ids     = implode(',', $request->input('ing'));
            if($request->file('uploads')){
                $file       = $request->file('uploads');
                $fileName   = $file->getClientOriginalName();
                $destinationPath = public_path().'/assets/images/uploads';
                $file->move($destinationPath,$fileName);
                $products->image = '/assets/images/uploads/'.$fileName;
            }
            $products->update();
            return redirect('/user/products')->with('status',"Product updated successfully");
        }
        catch(Exception $e){
            return redirect('/user/products')->with('failed',"Something went wrong");
        }
    }

    public function destroy($id)
    {
        try {
            $product = Products::find($id);
            if($product) {
                $product->delete();
                return redirect('/user/products')->with('status',"Product deleted successfully");
            } else {
                return redirect('/user/products')->with('failed',"Something went wrong");
            }
        }
        catch(Exception $e){
            return redirect('/user/products')->with('failed',"Something went wrong");
        }
    }
}
