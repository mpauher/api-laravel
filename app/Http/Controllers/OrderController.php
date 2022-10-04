<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    public function index(){
        try{
            $orders = Order::all();
            if(count($orders) == 0) {
                return response()->json();
            }
            return response()->json([
                'orders' => $orders,          
            ], 200);

        }catch (\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function show($id){
        try{
            $order = Order::find($id);

            return response()->json([
                'order' => $order
            ],200);

        }catch (\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function create(Request $request){
        try{
            $request->validate([
            'name'=>'required|string',
            'total'=>'required|numeric',     
            ]);

            $order = Order::create([
            'name'=>$request->name,
            'total'=>$request->total,
            ]);

            return response()->json([
                'message'=>'Carlos es el mejor profe del mundo '
            ]);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function update($id, Request $request){
        try{
            $order = Order::find($id);

            if(!$order){
                return response()->json([
                    'error'=>'Order not found'
                ],404);
            }

            $order->update($request->all());

            return response()->json([
                'message' => 'Order update succesfully',
            ],200);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
    
    public function destroy($id){
        try{
            $order = Order::find($id);
            if(!$order){
                return response()->json([
                    'error' =>'Order not found',
                ],404);    
            }

            Order::destroy($id);

            return response()->json([
                'message' => 'Order deleted succesfully',
            ],200);
        } catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }

    }
}
