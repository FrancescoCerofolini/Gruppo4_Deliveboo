@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xs-6">
           {{-- @dd($data); --}}
           {{-- @dd($data['quantity']) --}}
           {{-- <form action="{{ route('order.store') }}" method="post">
                @csrf

                <div class="form-group my-hidden">
                    <label>Ristorante</label>
                    <input type="text" name="user_id" class="form-control" value="{{$user_id}}">
                </div> --}}
                {{-- CARRELLO --}}
            <form id="myform" action="{{route('guest.payment')}}"> {{-- QUESTA È STATA CAMBIATA DA LAURA MENTRE PRIMA ESEGUIVA IL BOTTONE PAY CON UNO SCRIPT JAVASCRIPT --}}
                 <div v-show="flag_cart" class="form-group">
                     {{-- @foreach ($dishes as $dish)  --}}
                        <div v-for="(quantity, index) in quantity_dish" v-if="quantity_dish[index] > 0">
                             {{-- <h3>{{$dishes->name}}</h3>  --}}
                            <h3>@{{names_dish[index]}}</h3>

                            <label for="quantity[]">quantità</label>
                            <input type="number" id="quantity_cart" name="quantity[]" :value="quantity_dish[index]" class="form-control" readonly>
                        </div>

                        
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input name="amount" class="form-control" v-model="amount" readonly>
                        </div>

                        <div class="form-group">
                            <label for="delivery">spese di consegna</label>
                            <input type="number" value=3.00 name="delivery" class="form-control" readonly>
                        </div>
 
                    {{-- @endforeach --}}

                    

                    <button type="button" class="btn btn-success" v-on:click="hiddenCart">procedi al pagamento</button>
                    
                </div>
                {{-- DATI UTENTE --}}
                

                <div v-if="flag_cart == false" class="form-group">

                    <div class="form-group">
                        <label>Nome e Cognome</label>
                        <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Mario Rossi" v-model='nomeCognome' required max="255">
                    </div>
                    <div class="form-group">
                        <label>indirizzo email</label>
                        <input type="email" name="customer_email" class="form-control" id="customer_email" placeholder="name@example.com" v-model='indirizzoMail' required max="255" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$">
                    </div>
                    <div class="form-group">
                        <label>inserisci il tuo indirizzo</label>
                        <input type="text" name="customer_address" class="form-control" id="customer_address" v-model='indirizzo' required max="255">
                    </div>
                    <div class="form-group">
                        <label>numero di telefono</label>
                        <input type="text" name="customer_phone" class="form-control" id="customer_phone" v-model='numeroTelefono' required pattern="[0-9]{10}">
                    </div>
    

@section('content')
<div class="container">


        {{-- INPUT FORM --}}
    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
            <form class='ms-create-dish' action="{{ route('order.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <h1 >{{ strtoupper(str_replace('-', ' ', $data['user_slug'])) }}</h1>
                    <input type="hidden" name="user_id" class="form-control" value="{{$data['user_id']}}">
                    @php
                    $counter = 0;
                    @endphp
                    {{-- @dd($data['quantity'][$counter])    --}}
                    @php
                        $avaibleDishes = [];
                        foreach($data['dishes'] as $dish) {
                            if ($dish->visibility != 0) {
                                $avaibleDishes[] = $dish->id;
                            }
                        }
                        $nDishes = count($avaibleDishes);
                        
                    @endphp
                    <div v-if='flag_cart == false' class="amount-container">
                        <label for="amount">Totale €</label>
                        <input id='resoconto' :type="(flag_cart == false) ? 'number' : 'hidden'" name="amount" class="form-control" id="amount" v-model="amount" readonly>
                    </div>
                    
                @foreach ($data['dishes'] as $index => $dish)
                    @if ($dish->visibility == 1)                   
                
                    <div class="form-group ms-create-dish">
                        <div class="left-side">
                            <label v-if='flag_cart != false'>
                                <h3 class="name_dish">{{ucfirst($dish->name)}}</h3>
                                <h4>{{ucfirst($dish->description)}}</h4>
                                <h5>Prezzo : <span class="price">{{$dish->price}}€</span></h5>                            
                            </label>
                        </div>
                        <div class="right-side">
                            <input type="hidden" name="dish_id[]" class="form-control " value="{{ $dish->id }}">
                            @if ($data['quantity'] != null )
                            <input type='hidden' name="quantity[]" id="{{'quantity' . $index }}" class="quantity form-control @error('quantity') is-invalid @enderror" value="{{($data['quantity'][$counter] != "") ? $data['quantity'][$counter] : 0}}" v-on:change="amountFunction" required min="0"  max="10" readonly>  
                            @else
                            <input type='hidden' name="quantity[]" id={{'quantity' . $index }} class="quantity form-control @error('quantity') is-invalid @enderror" value="0" v-on:change="amountFunction" required min="0"  max="10" readonly> 
                            @endif
                            <button v-show="flag_cart != false" type='button' v-on:click='addToCart({{$index}})'>+</button><button v-show="flag_cart != false" type='button' v-on:click='decrementCart({{$index}})'>-</button>
                        </div>                            
                        
                        @error('quantity[]')
                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                        @enderror 
                    </div>
                    @php
                        $counter += 1;
                    @endphp
                    
                    @endif
                    
                @endforeach
                {{-- CURRENT MAIN --}}
                <input type='hidden' name="customer_name" class="form-control" :value="(nomeCognome == '') ? 'placeholder' : nomeCognome" required max="255">
                @error('customer_name')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
                <input type='hidden' name="customer_address" class="form-control" :value="(indirizzo == '') ? 'placeholder' : indirizzo" required max="255">
                @error('customer_address')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
                <input type='hidden' name="customer_email" class="form-control" :value="(indirizzoMail == '') ? 'placeholder' : indirizzoMail" required max="255" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$">
                @error('customer_email')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
                <input type='hidden' name="customer_phone" class="form-control" :value="(numeroTelefono == '') ? 'placeholder' : numeroTelefono"  required pattern="[0-9]{10}" >
                @error('customer_phone')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
                <input type='hidden' name="status" class="form-control" id="status" value="" readonly>
                <input type="hidden" name="delivery" value="3.00">

                <Button class='btn btn-danger create-home d-none  d-md-block' v-if='backToHome == false' v-on:click='backToHome = true'>Torna alla Home</Button>
                <button type='button' v-if='backToHome == false' class="create-home-mobile btn btn-danger d-md-none" v-on:click='backToHome = true'>
                    <i class="fas fa-home"></i>
                </button>
                
                <div v-if='backToHome == true' class='backToHome'>
                    <p>Tornando alla home perderai il contenuto attuale nel tuo carrello, vuoi continuare comunque?</p>
                    <button type='button'><a href="{{route('guest-home')}}">Si</a></button>
                    <button v-on:click='backToHome = false'>No</button>
                </div>

                {{-- Bottoni pagamento nel form di blade --}}
                
                <div class="form-group my-hidden">
                    <button id='ordine' type="submit">Automatico</button>
                </div>

            </form>
            
        </div>
    </div>
    {{-- INIZIO CARRELLO --}}
    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
        <div class="ms-cart">
            {{-- CARRELLO --}}
            <div v-show="flag_cart" class="form-group dish">
                <div v-for="(quantity, index) in quantity_dish" v-if="quantity_dish[index] > 0">
                    <span>@{{names_dish[index]}} :</span>
                    {{-- <label for="quantity[]">quantità</label> --}}
                    <input class='plate' type="number" id="quantity_cart" name="quantity[]" :value="quantity_dish[index]" readonly>
                </div>

                
                <div>
                    <label for="amount">Totale €</label>
                    <input id='amount' name="amount" v-model="amount" readonly>
                </div>

                <div>
                    <label for="delivery">Spese di consegna €</label>
                    <input id='consegna'type="number" value=3.00 name="delivery" readonly>
                </div> 
                
                {{-- <button class="btn btn-success" v-on:click='resetCart({{$nDishes}})' type='button'>Svuota il carrello</button> --}}

                <button type="button" class="btn btn-success" v-on:click="hiddenCart">Procedi al pagamento</button>
        
            </div>
            {{-- DATI UTENTE --}}
            

            <div v-show="flag_cart == false" class="form-group">

                <div class="form-group">
                    <label>Nome e Cognome</label>
                    <input type="text" name="customer_name" class="form-control" id="exampleFormControlInput1" placeholder="Mario Rossi" v-model='nomeCognome'>
                </div>
                <div class="form-group">
                    <label>Indirizzo email</label>
                    <input type="email" name="customer_email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" v-model='indirizzoMail'>
                    
                </div>
                <div class="form-group">
                    <label>Inserisci il tuo indirizzo</label>
                    <input type="text" name="customer_address" class="form-control" id="exampleFormControlInput1" v-model='indirizzo'>
                </div>
                <div class="form-group">
                    <label>Numero di telefono</label>
                    <input type="text" name="customer_phone" class="form-control" id="exampleFormControlInput1" value="+39" v-model='numeroTelefono'>
                </div>

                <div class="form-group my-hidden">
                    <label>status</label>
                    <input type='hidden' name="status" class="form-control"  :value="payment_status">
                </div>

                <button type="button" v-on:click="payment" class="btn btn-success"> Paga
                </button>
                <button v-on:click="flag_cart = true"class='btn btn-success'>Torna al carrello</button>
            </div>
        </div>
        
    </div>
        
    
            {{-- FINE CARRELLO --}}
</div>
@endsection

{{-- @section('extra-script')
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
@endsection --}}
