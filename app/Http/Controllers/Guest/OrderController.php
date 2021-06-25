<?php

namespace App\Http\Controllers\Guest;

use App\Dish;
use App\Order;
use App\User;

use App\Http\Controllers\Controller;
use Faker\Generator as Faker;
use Illuminate\Http\Request;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //dd($request);
        // $gateway = new \Braintree\Gateway([
        //     'environment' => config('services.braintree.environment'),
        //     'merchantId' => config('services.braintree.merchantId'),
        //     'publicKey' => config('services.braintree.publicKey'),
        //     'privateKey' => config('services.braintree.privateKey')
        // ]);

        // $token = $gateway->ClientToken()->generate();

        
        $user_id = $request['user_id'];
        $user_slug = $request['user_slug'];
        $quantity = $request['quantity'];
        $data = [
            'dishes' => Dish::all()->where('user_id', $user_id),
            'user_id' => $user_id,
            'user_slug' => $user_slug,
            'quantity' => $quantity,
            // 'token' => $token
        ];
        return view('guest.order.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Faker $faker)
    {
        // $request->validate([
        //     'customer_address' => 'required|string|max:255',
        //     'customer_email' => 'required|string|email|max:255',
        //     'customer_phone' => 'required|regex:/[0-9]{10}/',
        //     'customer_name' => 'required|string|max:255',
        //     'code' => 'unique',
        //     'amount' => 'required',
        // ]);    

        $data = $request->all();
        
        return view('guest.payment.welcome', compact('data'));
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
