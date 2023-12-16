<?php

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
Route::post('/user  /signup', [UserController::class, 'signup']);
Route::post('/user/login', [UserController::class, 'login']);

Route::group(['middleware'=>'auth:sanctum'], static function(){

    // Add other authenticated routes here
});
