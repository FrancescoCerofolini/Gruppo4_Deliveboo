<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">

                
                {{-- <form method="post" id="payment-form" action="{{ url('/payment/checkout') }}">
                    @csrf

                    <input name="customer_name" value="{{$request['customer_name']}}">
                    <input name="customer_address" value="{{$request['customer_address']}}">
                    <input name="customer_phone" value="{{$request['customer_phone']}}">
                    <input name="customer_email" value="{{$request['customer_email']}}">

                    <input name="user_slug" value="{{$request['user_slug']}}">
                    <input name="user_id" value="{{$request['user_id']}}">
                    <input name="dishes[]" value="{{$request['name_dish']}}">
                    <input name="amount" value="{{$request['amount']}}">
                    <input name="quantity[]" value="{{$request['quantity_dish']}}">

                    <div class="form-group my-hidden">
                        <button id='ordine' type="submit">Automatico</button>
                    </div>
                    <section>
                        <label for="amount">
                            <span class="input-label">Amount</span>
                            <div class="input-wrapper amount-wrapper">
                                <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                            </div>
                        </label>
                        
                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin"></div>
                        </div>
                    </section> 
                    

                    
                    
                    <input id="nonce" name="payment_method_nonce" type="hidden"  />
                    <button class="button" v-on:click="payment" type="submit"><span>Test Transaction</span></button>
                </form> --}}

                <form method="post" id="payment-form" action="{{ url('/guest/payment/checkout') }}">
                    @csrf
                    <section>
                        <label for="amount">
                            <span class="input-label">Amount</span>
                            <div class="input-wrapper amount-wrapper">
                                <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="{{$request['amount']}}" readonly>
                            </div>
                        </label>
                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin"></div>
                        </div>
                    </section>
                    
                    <input type="hidden" name="customer_name" value="{{$request['customer_name']}}">
                    <input type="hidden" name="customer_address" value="{{$request['customer_address']}}">
                    <input type="hidden" name="customer_phone" value="{{$request['customer_phone']}}">
                    <input type="hidden" name="customer_email" value="{{$request['customer_email']}}">
                    <input type="hidden" name="user_slug" value="{{$request['user_slug']}}">
                    <input type="hidden" name="user_id" value="{{$request['user_id']}}">
                    
                    <input type="hidden" name="amount" value="{{$request['amount']}}">
                    @php
                        $counter = 0;
                    @endphp
                    @foreach ($request['dish_id'] as $dish)
                        <input type="hidden" name="dish_id[]" value="{{$request['dish_id'][$counter]}}">
                        <input type="hidden" name="quantity[]" value="{{$request['quantity'][$counter]}}">
                        @php
                            $counter += 1;
                        @endphp
                    @endforeach
                    <input type="hidden" id="nonce" name="payment_method_nonce" />
                    
                    <button class="button" type="submit"><span>Test Transaction</span></button>
                </form>
            </div>
        </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";

        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          paypal: {
            flow: 'vault'
          }
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            

            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
                console.log('Request Payment Method Error', err);
                return;
              }

              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          });
        //   dropinInstance.requestPaymentMethod(function (requestPaymentMethodError, payload) {
        //         if (requestPaymentMethodError) {
        //             // handle errors
        //             return;
        //         }

        //         functionToSendNonceToServer(payload.nonce, function (transactionError, response) {
        //             if (transactionError) {
        //             // transaction sale with selected payment method failed
        //             // clear the selected payment method and add a message
        //             // to the checkout page about the failure
        //             dropinInstance.clearSelectedPaymentMethod();
        //             divForErrorMessages.textContent = 'my error message about entering a different payment method.';
        //             } else {
        //             // redirect to success page
        //             }
        //         });
        //     });
        });

    </script>
    <script>
        setTimeout(function(){ document.getElementById('ordine').click()};
    </script>
    </body>
</html>