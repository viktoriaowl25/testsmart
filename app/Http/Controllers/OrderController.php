<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Status;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arOrders = array();
        $orders = Order::all();
        $statuses = Status::all()->toArray();
        foreach($orders as $order) {
            $arOrders[] = array(
                'user' => $order->user()->first()->toArray(),
                'status' => $order->status()->first()->toArray(),
                'products' => $order->products()->get()->toArray(),
                'id' => $order->id
            );
        }

        return view('orders')->with(['orders'=> $arOrders, 'statuses' => $statuses]);
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
       
        $validated = $request->validate([
            'products' => 'nullable',
            'api_token' => 'nullable|required'
         ]);

        if($validated) {
            $order = new Order;
            $order->status_id = 1;

            $user = User::where('api_token', $request->input('api_token'))->first();

            if(!$user) {
                return response()->json([
                    'message' => 'error! not access 403',
                    'error' => '403'
                ])->setStatusCode(403);
            }

            $order->user_id = $user->id;
           
            $order->save();

            foreach(json_decode($request->input('products'), true) as $product) {
                $order->products()->attach($product);    
            }
            $order->save();

            return response()->json([
                'message' => 'Great success! order add',
                'order' => $order
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'message' => 'error! Order not add. Not Valided',
                'error' => '400'
            ])->setStatusCode(400);
        }
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
        $validated = $request->validate([
            'status_id' => 'nullable',
         ]);

        if($validated) {
            $order = Order::update($request->all());

            return response()->json([
                'message' => 'Great success! Order update',
                'order' => $order
            ])->setStatusCode(200);
        } else {
            return response()->json([
                'message' => 'error! Order not update. Not Valided',
                'error' => '400'
            ])->setStatusCode(400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'message' => 'Successfully deleted order!'
        ]);
    }
}
