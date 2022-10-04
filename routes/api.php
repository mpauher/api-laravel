<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderItemController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/hello',function(){
    return "Hello world";
});

Route::get('/products',[ProductController::class, 'index']);
Route::get('/products/{id}',[ProductController::class, 'show']);
Route::post('/products',[ProductController::class, 'create']);
Route::delete('/products/{id}',[ProductController::class, 'destroy']);
Route::get('/products/serial/{serial}',[ProductController::class, 'find_by_serial']);
Route::put('/products/{id}',[ProductController::class, 'update']);

Route::get('/orders',[OrderController::class, 'index']);
Route::get('/orders/{id}',[OrderController::class, 'show']);
Route::post('/orders',[OrderController::class, 'create']);
Route::delete('/orders/{id}',[OrderController::class, 'destroy']);
Route::put('/orders/{id}',[OrderController::class, 'update']);

Route::get('/users',[UserController::class, 'index']);
Route::get('/users/{id}',[UserController::class, 'show']);
Route::post('/users',[UserController::class, 'create']);
Route::delete('/users/{id}',[UserController::class, 'destroy']);
Route::put('/users/{id}',[UserController::class, 'update']);

Route::get('/order-items',[OrderItemController::class, 'index']);
Route::get('/order-items/{id}',[OrderItemController::class, 'show']);
Route::post('/order-items',[OrderItemController::class, 'create']);
Route::delete('/order-items/{id}',[OrderItemController::class, 'destroy']);
Route::put('/order-items/{id}',[OrderItemController::class, 'update']);






