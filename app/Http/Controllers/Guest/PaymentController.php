<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Dish;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Faker\Generator as Faker;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
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
    }

    public function paymentCheckout(Request $request, Faker $faker)
    {   
        
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
                'submitForSettlement' => true,
                // 'gatewayRejected' => true
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
        // dd($data);

        // @dd($result);

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
            $dish_names = [];
            foreach ($dish_ids as $id_dish) {
                $dish_name = Dish::where('id', $id_dish)->get();
                $dish_names [] = $dish_name;
            }
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
            $data[] = $code;
            $data[] = $dish_names;
            Mail::to($new_order->customer_email)->send(new SendNewMail($data));
            // dd($data);

            return (' mail inviata a ' . $new_order->customer_email . view('guest.order.show', $request, compact('dish_names'))); //($request['status'] == 'SUBMITTED_FOR_SETTLEMENT') ? 'Pagamento accettato, ' : 'null') . 
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            $msUser = new User();
            $msUser = User::select('slug')->where('id', $data['user_id'])->first();
            return view('guest.order.failed', compact('data', 'msUser'));
            
            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            // return view('guest.order.failed', $data);//back()->withErrors('An error occurred with the message: '.$result->message);
        }
    }
}
