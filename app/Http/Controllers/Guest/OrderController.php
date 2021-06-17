<?php

namespace App\Http\Controllers\Guest;

use App\Dish;
use App\Order;

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
        $user_id = $request['user_id'];
        $user_slug = $request['user_slug'];
        $data = [
            'dishes' => Dish::all()->where('user_id', $user_id),
            'user_id' => $user_id,
            'user_slug' => $user_slug,
        ];
        return view('guest.order.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Faker $faker)
    {
        $data = $request->all();
        //@dd($request);
        
        if ($data['status'] == 'SUBMITTED_FOR_SETTLEMENT') {
            $new_order = new Order();
            $new_order->status = $data['status'];
            $code = $faker->isbn10();
            $code_presente = Order::where('code', $code)->first();
            while ($code_presente) {
                $code = $faker->isbn10();
                $code_presente = Order::where('code', $code)->first();
            }
            $new_order->code = $code;
            $new_order->amount = $data['amount'];
            $new_order->fill($data);
            $new_order->save();

            return 'accettato:' . $data['status'];
        }
        else {
            return 'non accettato:' . $data['status'];
        }
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
