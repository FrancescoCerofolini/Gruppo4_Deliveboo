<?php

namespace App\Http\Controllers\Guest;

use App\Dish;
use App\Order;

use App\Http\Controllers\Controller;
use Faker\Generator as Faker;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = 1; // qui dobbiamo sostituire 1 con id del rispettivo ristorante
        $data = [
            'dishes' => Dish::all()->where('user_id', $user_id),

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
        
        if ($data['status'] == 'SETTLED') {
            $new_order = new Order();
            $new_order->status = $data['status'];
            $code = $faker->isbn10();
            $code_base = $code;
            $code_presente = Order::where('code', $code)->first();
            while ($code_presente) {
                $code = $faker->isbn10();
                $code_presente = Order::where('code', $code)->first();
            }
            $new_order->code = $code;
            
            $dish_ids = Dish::all()->where('user_id', 1)->pluck('id')->toArray();
            $counter = 0;
            $amount = 0;
            $new_order->amount = $amount;
            $new_order->fill($data);
            $new_order->save();
            foreach ($dish_ids as $value) {
                
                if ($data['quantity'][$counter]) {
                    
                    $new_order->dishes()->attach(['order_id' => $new_order->id], ['dish_id' => $value]);
                    
                    $new_order->dishes()->updateExistingPivot([$new_order->id, $value], ['quantity' => $data['quantity'][$counter]]);
                    $price = Dish::select('price')->where('user_id', 1)->where('id', $value)->get(['price'])->toArray()[0]["price"];
                    $amount = $amount + ($data['quantity'][$counter] * $price);
                }
                
                $counter = $counter + 1;
            }
            $new_order->amount = $amount;
            $new_order->update($data);
            return redirect()->route('order.create');
        }
        return 'non accettato';
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
