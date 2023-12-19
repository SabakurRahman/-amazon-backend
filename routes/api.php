<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SSLCommerzController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('products', ProductController::class);
Route::get('product/slug/{slug}', [ProductController::class, 'getProductBySlug']);

//Route::middleware('auth:sanctum')->group(function () {
//    Route::post('/user/signup', [UserController::class, 'signup']);
//    // Add other authenticated routes here
//});
Route::post('/user/signup', [UserController::class, 'signup']);
Route::post('/user/login', [UserController::class, 'login']);



Route::group(['middleware'=>'auth:sanctum'], static function(){

    // Add other authenticated routes here
    Route::post('/order', [OrderController::class, 'placeOrder']);
    Route::get('/order/{id}', [OrderController::class, 'getOrder']);
    Route::get('/key/paypal', [PaymentController::class, 'getSession']);
    Route::put('/orders/{id}/pay', [OrderController::class, 'updateOrder']);
    Route::get('user/order/history', [OrderController::class, 'getOrdersByUser']);
    Route::put('user/profile', [UserController::class, 'updateUserProfile']);



});
