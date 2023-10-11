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
        $buildings = Building::all();
        if (empty($building)) {
            return response()->json([
                'message' => 'Data not found'
            ]);
        }
        return response()->json($buildings);
    }
}