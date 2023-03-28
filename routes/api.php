<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', 'App\Http\Controllers\Api\RegisterController@register');
Route::post('login', 'App\Http\Controllers\Api\LoginController@login');
Route::group(['middleware'=>'auth:api'],function () {
    Route::post('logout', 'App\Http\Controllers\Api\LoginController@logout');
    Route::get('products', '\App\Http\Controllers\Api\ProductController@index');
    Route::post('products/show', '\App\Http\Controllers\Api\ProductController@show');
    Route::post('products/create', '\App\Http\Controllers\Api\ProductController@store');
    Route::post('products/update', '\App\Http\Controllers\Api\ProductController@update');
    Route::post('products/delete', '\App\Http\Controllers\Api\ProductController@delete');

});

