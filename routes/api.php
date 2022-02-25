<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('users')->group(function () {
    Route::resource('/', UserController::class);
    Route::get('getProductsDetails/{id}', [UserController::class, 'getProductsDetails']);
    Route::get('checkIfBuyedProduct/{userId}', [UserController::class, 'checkIfBuyedProduct']);
    Route::post('effettuaOrdine', [UserController::class, 'effettuaOrdine']);
    Route::post('{user_id}/getUserOrderByProduct/{product_id}', [OrdersController::class, 'getUserOrderByProduct']);
    Route::get('getMessages/{user_id}/{seller_id}', [UserController::class, 'getMessages']);
});

Route::resource('products', ProductsController::class);
Route::resource('orders', OrdersController::class);
Route::resource('sellers', SellerController::class);

Route::post('sendMessage', [MessageController::class, 'sendMessage']);
