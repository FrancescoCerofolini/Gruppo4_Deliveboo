<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Request;

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

Route::post('/checkout', function (Request $request) {
    
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;

    
    @dd($request);

    
});


Auth::routes();
Route::get('/', 'HomeController@index')->name('guest-home');
Route::prefix('guest')
    ->namespace('Guest')
    ->group(function () {
        Route::resource('/dish', 'DishController');
        Route::resource('dish', DishController::class)->names([
            'index' => 'guest.dish.index',
        ]);
        Route::resource('/order', 'OrderController')->names([
            'store' => 'order.store',
        ]);
        Route::resource('/category', 'CategoryController');
        
        Route::get('/payment', 'PaymentController@index1')->name('guest.payment');
        Route::post('/payment/checkout', 'PaymentController@index2')->name('guest.payment.checkout');
        Route::get('/payment/hosted', 'PaymentController@index3')->name('guest.payment.hosted');
        
    });
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('admin-home');
        Route::get('/statistics', 'StatisticsController@index')->name('admin-statistics');
        Route::resource('/dish', 'DishController');
        Route::resource('dish', DishController::class)->names([
            'index' => 'admin.dish.index',
            'create' => 'admin.dish.create',
            'destroy' => 'admin.dish.destroy',
            'update' => 'admin.dish.update',
            'show' => 'admin.dish.show',
            'edit' => 'admin.dish.edit',
            'store' => 'admin.dish.store',
        ]);
        Route::resource('/order', 'OrderController');
        Route::resource('order', OrderController::class)->names([
            'index' => 'admin.order.index',
            'create' => 'admin.order.create',
            'destroy' => 'admin.order.destroy',
            'update' => 'admin.order.update',
            'show' => 'admin.order.show',
            'edit' => 'admin.order.edit',
            'store' => 'admin.order.store',
        ]);
        Route::resource('/category', 'CategoryController');
        Route::resource('category', CategoryController::class)->names([
            'index' => 'admin.category.index',
            'create' => 'admin.category.create',
            'destroy' => 'admin.category.destroy',
            'update' => 'admin.category.update',
            'show' => 'admin.category.show',
            'edit' => 'admin.category.edit',
            'store' => 'admin.category.store',
        ]);
        });