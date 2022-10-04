<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index(){
        try{
            $users = User::all();
            if(count($users) == 0) {
                return response()->json();
            }
            return response()->json([
                'users' => $users,          
            ], 200);

        }catch (\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }

    public function show($id){
        try{
            $user = User::find($id);

            return response()->json([
                'user' => $user
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
            'lastname'=>'required|string',
            'email'=>'required|string',       
            ]);

            $order = User::create([
            'name'=>$request->name,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
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
            $user = User::find($id);

            if(!$user){
                return response()->json([
                    'error'=>'User not found'
                ],404);
            }

            $user->update($request->all());

            return response()->json([
                'message' => 'User update succesfully',
            ],200);
        }catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
    
    public function destroy($id){
        try{
            $user = User::find($id);
            if(!$user){
                return response()->json([
                    'error' =>'User not found',
                ],404);    
            }

            User::destroy($id);

            return response()->json([
                'message' => 'User deleted succesfully',
            ],200);
        } catch ( \Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }

    }}
