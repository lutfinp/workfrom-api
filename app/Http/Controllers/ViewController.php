<?php

namespace App\Http\Controllers;
use App\Models\Building;

class ViewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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