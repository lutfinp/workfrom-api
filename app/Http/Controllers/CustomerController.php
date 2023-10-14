<?php

namespace App\Http\Controllers;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
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
        $buildings = Building::all();
        if ($buildings->count() === 0) {
            return response()->json([
                'message' => 'Data not found',
            ]);
        }
        return response()->json($buildings);
    }

    public function showcustid(Request $request, $id)
    {
        $building = Building::where('user_id', $id)->first();
        if ($building->count() === 0) {
            return response()->json([
                'message' => 'Data not found',
            ]);
        }
        return response()->json($building);
    }

    public function showcustcity(Request $request, $city){
        $building = Building::where('city', $city)->get();
        if ($building->count() === 0) {
            return response()->json([
                'message' => 'Data not found',
            ]);
        }
        return response()->json([
            'message' => 'success',
            'data' => $building
        ]);

    }
    
    public function showcustcat(Request $request, $cat){
        $building = Building::where('category', $cat)->get();
        if (empty($building)) {
            return response()->json([
                'message' => 'Data not found'
            ]);
        }
        return response()->json([
            'message' => 'success',
            'data' => $building
        ]);

    }
}