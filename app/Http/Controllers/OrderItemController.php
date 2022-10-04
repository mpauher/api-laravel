<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;


class OrderItemController extends Controller
{
    public function index(){
        try{
            $orderItems = OrderItem::all();
            if(count($orderItems) == 0) {
                return response()->json();
            }
            return response()->json([
                'orderItems' => $orderItems,          
            ], 200);

        }catch (\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function show($id){
        try{
            $orderItem = OrderItem::find($id);

            return response()->json([
                'orderItem' => $orderItem
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
            'product_id'=>'required|integer',
            'order_id'=>'required|integer',  
            'price'=>'required|numeric',   
            'quantity'=> 'required|integer'     
            ]);

            $orderItem = orderItem::create([
            'product_id'=>$request->product_id,
            'order_id'=>$request->order_id,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
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
            $orderItem = OrderItem::find($id);

            if(!$orderItem){
                return response()->json([
                    'error'=>'Order not found'
                ],404);
            }

            $orderItem->update($request->all());

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
            $orderItem = OrderItem::find($id);
            if(!$orderItem){
                return response()->json([
                    'error' =>'Order not found',
                ],404);    
            }

            OrderItem::destroy($id);

            return response()->json([
                'message' => 'Order deleted succesfully',
            ],200);
        } catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }

    }}
