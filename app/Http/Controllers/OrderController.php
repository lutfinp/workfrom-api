<?php

namespace App\Http\Controllers;
use App\Models\Building;
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

    public function allorders() {
        $orders = Order::where('customer_id', Auth::user()->id)->get();
    
        $orderDetails = [];
    
        foreach ($orders as $order) {
            $building = Building::where('user_id', $order->building_id)->first();
            if ($building) {
                $orderDetails[] = $building;
            }
        }
    
        return response()->json([
            'message' => 'Success',
            'data' => $orderDetails
        ]);
    }

    public function addorders(Request $request, $id){
        $validated = $this->validate($request, [
            'start' => 'required',
            'finish' => 'required',
            'price' => 'required',
        ]);
    
        $order = new Order();
        $order->start = date('Y-m-d', strtotime($validated['start']));
        $order->finish = date('Y-m-d', strtotime($validated['finish']));
        $order->price = $validated['price'];
        $order->customer_id = Auth::user()->id;
        $order->building_id = $id;
        $order->save();
    
        return response()->json([
            'message' => 'success',
            'data' => $order
        ]);
    }

}