<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Types;

use App\Models\Orders;
use App\Models\Ingredients;
use App\Models\Measurements;
use App\Models\ProductIngredients;

class ProductsController extends Controller
{
    protected $products;

    public function __construct(Products $products)
    {
        $this->products = $products;
    }

    public function index() {
        return response()->json(Products::with('ingredients')->get(), 200);
    }
    public function show($id)
	{
        $product = Products::with('ingredients')->find($id)->get();
	    return response()->json($product, 200);
	}
    public function getProduct($id)
	{
        $product = Products::with('ingredients')->where('id', $id)->get();
	    return response()->json($product, 200);
	}
    public function getProductIngredients($id)
	{
        $product = ProductIngredients::find($id);
	    return response()->json($product, 200);
	}
    public function getProductOrdered()
	{
        $ordered = Orders::select('products_id')
            ->groupBy('products_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(1)
            ->get();
	    return response()->json($ordered, 200);
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
    public function delete($id)
    {
        try {
            $product = Products::find($id);
            if($product) {
                $product->delete();
                return response()->json($product, 204);
            } else {
                return response()->json([], 404);
            }
        }
        catch(Exception $e){
            return response()->json([], 404);
        }
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
            'ing'              => 'required',
            'measure'          => 'required'
        ]);

        $arryIng = $request->input('ing');
        $arryMsr = $request->input('measure');

        $products = new Products();
        $products->name        = $request->input('name');
        $products->description = $request->input('description');
        $products->price       = $request->input('price');
        $products->category_id = $request->input('category_id');
        $products->ing_ids     = implode(',', $arryIng);
        $products->measurement_ids     = implode(',', $arryMsr);
        if($request->file('uploads')){
            $file       = $request->file('uploads');
            $fileName   = $file->getClientOriginalName();
            $destinationPath = public_path().'/assets/images/uploads';
            $file->move($destinationPath,$fileName);
            $products->image = '/assets/images/uploads/'.$fileName;
        }
        $products->save();
        // save the product ingredients
        // get the ingredients
        if (sizeof($arryIng)) {
            for($i = 0;$i<sizeof($arryIng);$i++)
            {
                $ingredient = Ingredients::find($arryIng[$i]);
                $measurement = Measurements::find($arryIng[$i]);
                ProductIngredients::create([
                    'name' => $ingredient['name'],
                    'tag' => $ingredient['tag'],
                    'products_id' => $products['id'],
                    'types_id' => $ingredient['types_id'],
                    'measurements_id' => $measurement['id'],
                    'measurement' => $measurement['volume'],
                    'actuator' => $ingredient['actuator'],
                    'unit' => $measurement['unit'],
                    'price' => $measurement['price'],
                    'volume' => $ingredient['volume'],
                ]);
            }
        }
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
