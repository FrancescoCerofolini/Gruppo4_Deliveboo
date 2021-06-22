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
        $user_id = $request['user_id'];
        $user_slug = $request['user_slug'];
        $quantity = $request['quantity'];
        $data = [
            'dishes' => Dish::all()->where('user_id', $user_id),
            'user_id' => $user_id,
            'user_slug' => $user_slug,
            'quantity' => $quantity
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
        $data = $request->all();
        // @dd($data);

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
            $new_order->amount = $data['amount'] + $data['delivery'];
            $new_order->fill($data);
            $new_order->save();

            // Codice Laura
            $amount = 0;
            $counter = 0;
            $dish_ids = $data['dish_id'];
            foreach ($dish_ids as $value) {

                if ($data['quantity'][$counter]) {

                    $new_order->dishes()->attach(['order_id' => $new_order->id], ['dish_id' => $value]);

                    $new_order->dishes()->updateExistingPivot([$new_order->id, $value], ['quantity' => $data['quantity'][$counter]]);
                    $price = Dish::select('price')->where('user_id', $data['user_id'])->where('id', $value)->get(['price'])->toArray()[0]["price"];
                    $amount = $amount + ($data['quantity'][$counter] * $price);
                }

                $counter = $counter + 1;
            }
            $new_order->amount = $amount + $data['delivery'];
            $data["amount"] = $data["amount"] + $data['delivery'];
            $new_order->update($data);
            
            //dd($msUser);

            // $user_slug = User::all()->where('id', $data['user_id']);

            // @dd($user_slug);

            Mail::to($new_order->customer_email)->send(new SendNewMail($new_order));

            return (($data['status'] == 'SUBMITTED_FOR_SETTLEMENT') ? 'Pagamento accettato, ' : 'null') . ' mail inviata a ' . $new_order->customer_email . view('guest.order.store', $data);
        }
        else {
            $msUser = new User();
            $msUser = User::select('slug')->where('id', $data['user_id'])->first();
            return view('guest.order.ciao', compact('data', 'msUser') );
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
