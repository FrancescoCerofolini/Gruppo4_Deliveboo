<?php

namespace App\Http\Controllers\Guest;

use App\Dish;
use App\Order;
use App\User;

use App\Http\Controllers\Controller;
use Faker\Generator as Faker;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index1(Request $request)
    {
        $data = $request->all();
        $amount = $request->amount;
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    
        $token = $gateway->ClientToken()->generate();
    
        return view('guest.payment.welcome', [
            'token' => $token,
            'amount' => $amount,

        ]);

    }

    public function index2(Request $request,Faker $faker)
    {

        $data = $request->all();
        @dd($data);
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;
    
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
            ], compact('data')
        ]);
        
        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: transaction.php?id=" . $transaction->id);
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

        
            Mail::to($new_order->customer_email)->send(new SendNewMail($new_order));

            return (' mail inviata a ' . $new_order->customer_email . view('guest.order.store', $data));
            
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('An error occurred with the message: '.$result->message);
        }

    }

    
}
