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

    public function showcustloc(Request $request, $loc){
        $building = Building::where('location', $loc)->get();
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