<?php

namespace App\Http\Controllers;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all(){
        $buildings = Building::where('owner_id', Auth::user()->id)->get();
        if (empty($building)) {
            return response()->json([
                'message' => 'Data not found'
            ]);
        }
        return response()->json($buildings);
    }

    public function add(Request $request){
        $validated = $this->validate($request, [
            'name' => 'required|max:255',
            'facility' => 'required',
            'location' => 'required',
            'size' => 'required',
            'accommodate' => 'required',
            'price' => 'required',
            'category' => 'required'
        ]);

        $building = new Building();
        $building->name = $validated['name'];
        $building->facility = $validated['facility'];
        $building->location = $validated['location'];
        $building->size = $validated['size'];
        $building->accommodate = $validated['accommodate'];
        $building->price = $validated['price'];
        $building->category = $validated['category'];
        $building->owner_id = Auth::user()->id;
        $building->save();
        return response()->json($building);

    }

    public function show(Request $request, $id)
    {
        $building = Building::where('user_id', $id)->where('owner_id', Auth::user()->id)->first();
        if (empty($building)) {
            return response()->json([
                'message' => 'Data not found'
            ]);
        }
        return response()->json($building);
    }

    public function update(Request $request, $id)
    {
        $building = Building::where('user_id', $id)->where('owner_id', Auth::user()->id)->first();
        if (empty($building)) {
            return response()->json([
                'message' => 'Data not found'
            ]);
        }
        $validated = $this->validate($request, [
            'name' => 'required|max:255',
            'facility' => 'required',
            'location' => 'required',
            'size' => 'required',
            'accommodate' => 'required',
            'price' => 'required',
            'category' => 'required'
        ]);
        $building->name = $validated['name'];
        $building->facility = $validated['facility'];
        $building->location = $validated['location'];
        $building->size = $validated['size'];
        $building->type = $validated['type'];
        $building->price = $validated['price'];
        $building->category = $validated['category'];
        $building->save();
        return response()->json($building);
    }

    public function delete(Request $request, $id)
    {
        $building = Building::where('user_id', $id)->where('owner_id', Auth::user()->id)->first();
        if (empty($building)) {
            return response()->json([
                'message' => 'Data not found'
            ]);
        }
        $building->delete();
        return response()->json(['message' => 'Data deleted']);
    }

}