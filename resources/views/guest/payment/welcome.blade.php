@extends('layouts.app');


    
    

@section('content2')
    <div class="container min-vh-50">
        <div class="row">
            <div class="col-3">
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
                <div class="justify-content-center ">
                    @if (Route::has('login'))
                        <div class="top-right links my-hidden">
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
                        <form method="post" id="payment-form" action="{{ url('/guest/payment/checkout') }}">
                            @csrf
                            <section>
                                <label for="amount">
                                    <span class="input-label">Prezzo Totale</span>
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
                            
                            <button class="btn btn-success" id="btn-hidden" on-click="timeoutButton" type="submit"><span>Paga</span></button>
                        </form>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
        <script src="https://pay.google.com/gp/p/js/pay.js"></script>
        <script src="https://js.braintreegateway.com/web/3.78.2/js/client.min.js"></script>
        <script src="https://js.braintreegateway.com/web/3.78.2/js/google-payment.min.js"></script>
        <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";
        var paymentsClient = new google.payments.api.PaymentsClient({
        environment: 'TEST'
        });
        braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
            // card: {
            //     overrides: {
            //     styles: {
            //         input: {
            //         color: 'blue',
            //         'font-size': '18px'
            //         },
            //         '.number': {
            //         'font-family': 'monospace'
            //         // Custom web fonts are not supported. Only use system installed fonts.
            //         },
            //         '.invalid': {
            //         color: 'red'
            // }
            paypal: {
            flow: 'vault',
            buttonStyle: {
            color: 'blue',
            shape: 'rect',
            size: 'medium'
            }
            },
            venmo: {
                allowNewBrowserTab: false
            },
            googlePay: {
            googlePayVersion: 2,
            merchantId: 'merchant-id-from-google',
            transactionInfo: {
            totalPriceStatus: 'FINAL',
            totalPrice: '1.00',
            currencyCode: 'USD'
            },
            
        }
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            console.log('ciao');
            

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
          
        });
        

        </script>
        
@endsection 

        

    

