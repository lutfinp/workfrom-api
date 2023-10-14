<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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

    public function add(Request $request){
        $validated = $this->validate($request, [
            'start' => 'required',
            'finish' => 'required',
            'price' => 'required',
        ]);

        $order = new Order();
        $order->start = $validated['start'];
        $order->finish = $validated['finish'];
        $order->price = $validated['price'];
        $order->customer_id = Auth::user()->id;
        $order->save();
        return response()->json([
            'message' => 'success',
            'data' => $order
        ]);
    }

    public function showOrdersForUserAndBuilding(Request $request, $user_id, $building_id)
    {
        // Mengambil order berdasarkan user_id dan building_id
        $orders = Order::where('user_id', $user_id)
                      ->where('building_id', $building_id)
                      ->get();

        return response()->json($orders);
    }

    public function showOrdersForOwner(Request $request, $owner_id)
    {
        // Mengambil order berdasarkan owner_id
        $orders = Order::where('owner_id', $owner_id)->get();

        return response()->json($orders);
    }
}