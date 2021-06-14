<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



Auth::routes();
Route::get('/', 'HomeController@index')->name('guest-home');
Route::prefix('guest')->namespace('Guest')->group(function () {
    Route::resource('/dish', 'DishController');
    Route::resource('/order', 'OrderController');
    Route::resource('/category', 'CategoryController');
});
Route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('admin-home');
    Route::resource('/dish', 'DishController');
    Route::resource('/order', 'OrderController');
    Route::resource('/category', 'CategoryController');
});