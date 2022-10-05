<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index(){
        try{
            $orders = Order::all();
            if(count($orders) == 0) {
                return response()->json([
                    'message' => 'Order not found'
                ]);
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


            return DB::transaction(function () use ($request) {
                $reference = Str::random(10).'_'.Carbon::now();
                $request->validate([
                    'user_id' => 'required|integer',
                    'items' => 'required|array'
                ]);   
    
                $order = Order::create([
                    'reference'=>$reference,
                    'user_id'=>$request->user_id,
                ]);
    
                $subtotal = 0;
                $total = 0;
    
                foreach($request->items as $item){
                    $product = Product::find($item['product_id']);
                    
                    if($item['quantity']<= $product->quantity){
                        // $price = Product::find($item['product_id'])->price;
                        $orderItem = OrderItem::create([
                            'order_id' => $order->id,
                            'product_id' => $item['product_id'],
                            'quantity' => $item['quantity'],
                            'price' => $product->price
                        ]);

                        $product->update([
                            'quantity' => $product->quantity - $item['quantity']
                        ]);
                        $subtotal = $subtotal + ($product->price * $orderItem->quantity);
                    } else{
                        return response()->json([
                            'error'=>'Product quantity not enough',
                        ],404);
                    }
                }
    
                $total = $total + ($subtotal * 1.19);
                $order->total = $total;
                $order->subtotal = $subtotal;
                $order->save();
                return response()->json([
                    'message'=>'ok'
                ], 201);
            }, 5);


            

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
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
