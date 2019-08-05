<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/orders', 'ApiOrderController@all')->name('orders.index');

Route::post('/orders', 'ApiOrderController@store')->name('orders.store');

Route::get('/orders/{order}', 'ApiOrderController@show')->name('orders.show');

Route::put('/orders/{order}', 'ApiOrderController@update')->name('orders.update');

Route::delete('/orders/{order}', 'ApiOrderController@destory')->name('products.destroy');