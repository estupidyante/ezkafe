<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Measurements;

class MeasurementsController extends Controller
{
    protected $measurements;

    public function __construct(Measurements $measurements)
    {
        $this->measurements = $measurements;
    }
    public function index() {
        return response()->json(Measurements::all(), 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->input();
        Measurements::create([
            'label' => $data['name'],
            'name' => $data['name'],
            'value' => $data['volume'],
            'unit' => $data['unit'],
            'price' => $data['price'],
        ]);

        return redirect('/user/measurements')->with('status',"Measurement created successfully");
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();

        try {
            $measurement = Measurements::find($id);
            $measurement->label = $data['name'];
            $measurement->name = $data['name'];
            $measurement->value = $data['volume'];
            $measurement->unit = $data['unit'];
            $measurement->price = $data['price'];
            $measurement->update();
            return redirect('/user/measurements')->with('status',"Measurement updated successfully");
        }
        catch(Exception $e){
            return redirect('/user/measurements')->with('failed',"Something went wrong");
        }
    }

    public function destroy($id)
    {
        try {
            $measurement = Measurements::find($id);
            $measurement->delete();
            return redirect('/user/measurements')->with('status',"Measurement deleted successfully");
        }
        catch(Exception $e){
            return redirect('/user/measurements')->with('failed',"Something went wrong");
        }
    }
}
