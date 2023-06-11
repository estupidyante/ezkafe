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
        $products->category_id = $request->input('category_id');
        $products->ing_ids     = implode(',', $request->input('ing'));

        if($request->file('uploads')){
            $file       = $request->file('uploads');
            $filename   = $file->getClientOriginalName();
            $file-> move(public_path('assets/uploads'), $filename);
            $products->image = $filename;
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
            $products->category_id = $request->input('category_id');
            $products->ing_ids     = implode(',', $request->input('ing'));
            if($request->file('uploads')){
                $file       = $request->file('uploads');
                $filename   = $file->getClientOriginalName();
                $file-> move(public_path('assets/uploads'), $filename);
                $products->image = $filename;
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
