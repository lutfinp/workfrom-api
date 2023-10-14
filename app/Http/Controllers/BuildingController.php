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
        if ($buildings->count() === 0) {
            return response()->json([
                'message' => 'Data not found',
            ]);
        }
        return response()->json($buildings);
    }

    public function add(Request $request){
        $validated = $this->validate($request, [
            'name' => 'required|max:255',
            'facility' => 'required',
            'location' => 'required',
            'city' => 'required',
            'provinc' => 'required',
            'size' => 'required',
            'accommodate' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required'
        ]);

        $building = new Building();
        $building->name = $validated['name'];
        $building->facility = $validated['facility'];
        $building->location = $validated['location'];
        $building->city = $validated['city'];
        $building->provinc = $validated['provinc'];
        $building->size = $validated['size'];
        $building->accommodate = $validated['accommodate'];
        $building->description = $validated['description'];
        $building->price = $validated['price'];
        $building->category = $validated['category'];
        $building->owner_id = Auth::user()->id;
        $building->save();
        return response()->json([
            'message' => 'success',
            'data' => $building
        ]);

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
    // Pastikan hanya pemilik bangunan yang dapat mengupdate
    $building = Building::where('user_id', $id)->where('owner_id', Auth::user()->id)->first();

    if (empty($building)) {
        return response()->json(['message' => 'Data not found'], 404);
    }

    $validated = $this->validate($request, [
        'name' => 'required|max:255',
        'facility' => 'required',
        'location' => 'required',
        'city' => 'required',
        'provinc' => 'required', // Ubah 'provinc' menjadi 'province'
        'size' => 'required',
        'accommodate' => 'required',
        'description' => 'required',
        'price' => 'required',
        'category' => 'required'
    ]);

    $building->update($validated);

    return response()->json(['message' => 'Data updated successfully', 'building' => $building]);
}

    public function delete(Request $request, $id)
    {
        $building = Building::where('user_id', $id);
        if (empty($building)) {
            return response()->json([
                'message' => 'Data not found'
            ]);
        }
        $building->delete();
        return response()->json(['message' => 'Data deleted']);
    }

}