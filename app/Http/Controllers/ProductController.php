<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function index(){

        try{
            $products = Product::all();
            if(count($products) == 0) {
                return response()->json();
            }
            return response()->json([
                'products' => $products,          
            ], 200);

        } catch (\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function show($id){
        $product = Product::find($id);

        return response()->json([
            'product' => $product
        ]);
    }

    public function find_by_serial($serial){

        try{
            $product = Product::where('serial', $serial)->first();

            if(!$product){
                return response()->json([
                    'error' =>'Product not found',
                ],404);    
            }

            return response()->json([
                'product' => $product
            ]);

        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);            
        }
    }

    public function create(Request $request){

        try{
            $request->validate([
            'name'=>'required|string',
            'price'=>'required|numeric',
            'description' => 'nullable|string',
            'quantity'=> 'required|integer',
            'featured'=> 'boolean',
            'serial' => 'string'         
            ]);

            $product = Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'description' => $request->description,
            'quantity'=> $request->quantity,
            'serial' => $request->serial
            ]);

            return response()->json($product);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }

    }

    public function update($id, Request $request){
        try{
            $product = Product::find($id);

            if(!$product){
                return response()->json([
                    'error'=>'Product not found'
                ],404);
            }

            $product->update($request->all());

            return response()->json([
                'message' => 'Product update succesfully',
            ],200);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function destroy($id){

        try{
            $product = Product::find($id);
            if(!$product){
                return response()->json([
                    'error' =>'Product not found',
                ],404);    
            }

            Product::destroy($id);

            return response()->json([
                'message' => 'Product deleted succesfully',
            ],200);
        } catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
}
