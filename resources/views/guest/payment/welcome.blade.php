

@extends('layouts.app');



{{-- @section('content')
    <div class="container">
        <div class="row-justify-content">
                <div class="col-12">

                    <br>
                    <br>
                    <br>

                    <div>
                        <h2>Riepilogo</h2>
                        <h3>
                            <input type="hidden" name="user_id" class="form-control" value="{{$data['user_id']}}">
                        </h3>
                        <h3>{{$data['customer_name']}}</h3>
                        <h3>{{$data['customer_address']}}</h3>
                        <h3>{{$data['customer_email']}}</h3>
                        <h3>{{$data['customer_phone']}}</h3>
                    </div>

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
                        <div class="content">
                            <form method="post" id="payment-form" action="{{ route('order.store') }}">
                                @csrf

                                <div class="my-hidden">
                                    <input type="hidden" name="user_id" class="form-control" value="{{$data['user_id']}}">
                                    <input class='plate' type="number" id="quantity_cart" name="quantity[]" :value="quantity_dish[index]" readonly>
                
                                    <input type="text" name="customer_name" value="{{$data['customer_name']}}">
                                    <input type="text" name="customer_address" value="{{$data['customer_address']}}">
                                    <input type="email" name="customer_email" value="{{$data['customer_email']}}">
                                    <input type="text" name="customer_phone" value="{{$data['customer_phone']}}">
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

                                <input id="nonce" name="payment_method_nonce" type="hidden" />
                                <button class="button" type="submit" id="test"><span>Test Transaction</span></button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
    
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";

        braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
            /* paypal: {
                flow: 'vault'
            } */
        }, function (createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            };
            form.addEventListener('submit', function (event) {
                console.log('eccomi');
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
            /* document.getElementById('test').addEventListener('click', function() {
                console.log('ciao');

                instance.requestPaymentMethod(function (err, payload) {
                    if (err) {
                        console.log('Request Payment Method Error', err);
                        return;
                }});

                // Add the nonce to the form and submit
                console.log(payload.nonce);
                document.querySelector('#nonce').value = payload.nonce;
                //document.getElementById('nonce').value = payload.nonce;
                console.log(document.getElementById('nonce').value);
                form.submit();
            }); */
        });
    </script>

@endsection
 --}}

 @section('content')
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
            <form method="post" id="payment-form" action="{{ url('/checkout') }}">
                @csrf
                <section>
                    {{-- <div class="my-hidden">
                        <input type="hidden" name="user_id" class="form-control" value="{{$data['user_id']}}">
                        <input class='plate' type="number" id="quantity_cart" name="quantity[]" :value="quantity_dish[index]" readonly>
    
                        <input type="text" name="customer_name" value="{{$data['customer_name']}}">
                        <input type="text" name="customer_address" value="{{$data['customer_address']}}">
                        <input type="email" name="customer_email" value="{{$data['customer_email']}}">
                        <input type="text" name="customer_phone" value="{{$data['customer_phone']}}">
                    </div> --}}
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

                <input id="nonce" name="payment_method_nonce" {{-- type="hidden" --}} />
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
    });
</script>
@endsection