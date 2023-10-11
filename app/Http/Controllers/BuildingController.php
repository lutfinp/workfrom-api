<?php

namespace App\Http\Controllers;
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
        return response()->json(Auth::user()->buildings);
    }


}