<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware'=>'auth'],function (){
    Route::resource('products', \App\Http\Controllers\ProductController::class);
    Route::get('products/delete/{id}', '\App\Http\Controllers\ProductController@delete')->name('products.destroy');
################################## groups ######################################
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', '\App\Http\Controllers\RolesController@index')->name('roles.index');
        Route::get('create', '\App\Http\Controllers\RolesController@create')->name('roles.create');
        Route::post('store', '\App\Http\Controllers\RolesController@saveRole')->name('roles.store');
        Route::get('/edit/{id}', '\App\Http\Controllers\RolesController@edit') ->name('roles.edit') ;
        Route::post('update/{id}', '\App\Http\Controllers\RolesController@update')->name('roles.update');
    });
    ################################## Users of Dashboard ######################################
    Route::group(['prefix' => 'users_dashboard'  ], function () {
        Route::get('/', '\App\Http\Controllers\UsersDasboardController@index')->name('users.Dashboard.index');
        Route::get('/create', '\App\Http\Controllers\UsersDasboardController@create')->name('users.Dashboard.create');
        Route::post('/store', '\App\Http\Controllers\UsersDasboardController@store')->name('users.Dashboard.store');
        Route::get('/edit/{id}', '\App\Http\Controllers\UsersDasboardController@edit') ->name('users.Dashboard.edit') ;
        Route::post('update/{id}', '\App\Http\Controllers\UsersDasboardController@update')->name('users.Dashboard.update');
        Route::get('/delete/{id}', '\App\Http\Controllers\UsersDasboardController@destroy') ->name('users.Dashboard.destroy') ;
    });

});
