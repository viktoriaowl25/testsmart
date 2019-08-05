<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Status;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('api.key');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $orders = Order::all();

        return response()->json($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'nullable',
         ]);

        $order = new Order;
        $order->status_id = 1;

        $user = auth()->user();
        $order->user_id = $user->id;
        $order->save();

        foreach(json_decode($request->input('products'), true) as $product) {
            $order->products()->attach($product);    
        }
        $order->save();

        return response()->json(['message' => 'Great success! order add', 'order' => $order]);  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response()->json([
            'message' => 'Great success! Order show',
            'order' =>  $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $obOrder = array();
        $request->validate([
            'status_id' => 'nullable',
         ]);

 
        $newStatus = $request->input('status_id'); 
        $beforeStatus =  $order->status_id;

        if( $beforeStatus == 1 && ($newStatus == 2 || $newStatus == 5) ||
            $beforeStatus == 2 && ($newStatus == 3 || $newStatus == 5) ||
            $beforeStatus == 3 && ($newStatus == 4 || $newStatus == 5)) {
            
                $order->status_id = $request->input('status_id');
                $order->save();
        } else {
            return response()->json(['message' => 'Do not update Status!']);
        }

        $obOrder = array(
            'id' => $order->id,
            'status' => $order->status()->first()->toArray()
        );

        return response()->json(['message' => 'Great success! Order update', 'order' => $obOrder]);
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $product->delete();

        return response()->json(['message' => 'Successfully deleted product!']);
    }
}
