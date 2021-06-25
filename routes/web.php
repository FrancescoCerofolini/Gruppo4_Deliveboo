<?php

use App\Dish;
use App\Order;
use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Faker\Generator as Faker;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;
 
use \Illuminate\Http\Response;

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
Route::prefix('guest')
    ->namespace('Guest')
    ->group(function () {
        Route::resource('/dish', 'DishController');
        Route::resource('dish', DishController::class)->names([
        'index' => 'guest.dish.index',
        ]);
        Route::resource('/order', 'OrderController');
        Route::resource('/category', 'CategoryController');
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

//pagamenti

Route::get('/payment', function (Request $request) {
    $gateway = new \Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $token = $gateway->ClientToken()->generate();

    return view('guest.payment.welcome', [
        'token' => $token,
        'request' => $request
    ]);
});
    

Route::post('/payment/checkout', function (Request $request, Faker $faker) {
    
    
    $gateway = new \Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;
    //@dd($request);

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'customer' => [
            'firstName' => 'Tony',
            'lastName' => 'Stark',
            'email' => 'tony@avengers.com',
        ],
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    // $request->validate([
    //     'customer_address' => 'required|string|max:255',
    //     'customer_email' => 'required|string|email|max:255',
    //     'customer_phone' => 'required|regex:/[0-9]{10}/',
    //     'customer_name' => 'required|string|max:255',
    //     'code' => 'unique',
    //     'amount' => 'required',
    // ]);

    $data = $request->all();
    
    // @dd($data);



    if ($result->success) {
        $new_order = new Order();
        $new_order->status = 'paid';
        $code = $faker->isbn10();
        $code_presente = Order::where('code', $code)->first();
        while ($code_presente) {
            $code = $faker->isbn10();
            $code_presente = Order::where('code', $code)->first();
        }
        $new_order->code = $code;
        $new_order->amount = $request['amount']; // + $request['delivery'];
        $new_order->fill($data);
        $new_order->save();
        //@dd('ciao, ok pagamento');

        $transaction = $result->transaction;
        // header("Location: transaction.php?id=" . $transaction->id);

        //return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
        //return view('guest.order.store');
       
        

        // Codice Laura
        $amount = 0;
        $counter = 0;
        $dish_ids = $request['dish_id'];
        foreach ($dish_ids as $dish_id) {

            if ($request['quantity'][$counter]) {

                $new_order->dishes()->attach(['order_id' => $new_order->id], ['dish_id' => $dish_id]);

                $new_order->dishes()->updateExistingPivot([$new_order->id, $dish_id], ['quantity' => $request['quantity'][$counter]]);
                $price = Dish::select('price')->where('user_id', $request['user_id'])->where('id', $dish_id)->get(['price'])->toArray()[0]["price"];
                $amount = $amount + ($request['quantity'][$counter] * $price);
            }

            $counter = $counter + 1;
        }
        $new_order->amount = $amount + $request['delivery'];
        $request["amount"] = $request["amount"] + $request['delivery'];
        $new_order->update($data);

        //dd($msUser);

        // $user_slug = User::all()->where('id', $request['user_id']);

        // @dd($user_slug);

        Mail::to($new_order->customer_email)->send(new SendNewMail($new_order));

        return (($request['status'] == 'SUBMITTED_FOR_SETTLEMENT') ? 'Pagamento accettato, ' : 'null') . ' mail inviata a ' . $new_order->customer_email . view('guest.order.show', $request);
    } else {
        $errorString = "";

        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: index.php");
        return back()->withErrors('An error occurred with the message: '.$result->message);
    }
});