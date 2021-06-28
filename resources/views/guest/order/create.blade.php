@extends('layouts.app')

@section('title', 'Ordine')
    

@section('content')
<div class="container">


        {{-- INPUT FORM --}}
    <div class="row justify-content-flex-start">
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
            <form class='ms-create-dish' action="#" method="post" enctype="multipart/form-data">
                @csrf
                
                <h1>{{ strtoupper(str_replace('-', ' ', $data['user_slug'])) }}</h1>
                    <input type="hidden" name="user_id" class="form-control" value="{{$data['user_id']}}">
                    @php
                    $counter = 0;
                    @endphp

                    @php
                        $avaibleDishes = [];
                        foreach($data['dishes'] as $dish) {
                            if ($dish->visibility != 0) {
                                $avaibleDishes[] = $dish->id;
                            }
                        }
                        $nDishes = count($avaibleDishes);
                        
                    @endphp
                    
                @foreach ($data['dishes'] as $index => $dish)
                    @if ($dish->visibility == 1)                   
                
                    <div class="form-group ms-create-dish">
                        <div class="left-side">
                            <label>
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
                            <button v-show="flag_cart" type='button' v-on:click='addToCart({{$index}}), cartShow = true'>+</button><button v-show="flag_cart != false" type='button' v-on:click='decrementCart({{$index}}), cartShow = true'>-</button>
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
                <div v-if='!flag_cart' class="amount-container">
                    <label for="amount">Totale : €</label>
                    <input id='resoconto' :type="(flag_cart == false) ? 'number' : 'hidden'" name="amount" class="form-control" id="amount" v-model="amount" readonly>
                </div>
                {{-- CURRENT MAIN --}}
                <input type='hidden' name="customer_name" class="form-control" :value="(nomeCognome == '') ? 'placeholder' : nomeCognome" required max="255" min='1'>
                @error('customer_name')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
                <input type='hidden' name="customer_address" class="form-control" :value="(indirizzo == '') ? 'placeholder' : indirizzo" required max="255" min='1'>
                @error('customer_address')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
                <input type='hidden'name="customer_email" class="form-control" :value="(indirizzoMail == '') ? 'placeholder' : indirizzoMail" required max="255" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$" min='1'>
                @error('customer_email')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
                <input type='hidden' name="customer_phone" class="form-control" :value="(numeroTelefono == '') ? 'placeholder' : numeroTelefono"  required pattern="[0-9]{10}" min='10'>
                @error('customer_phone')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                @enderror
                <input type='hidden' name="status" class="form-control" id="status" value="" readonly>
                <input type="hidden" name="delivery" value="3.00">

                <Button class='btn btn-danger create-home d-none  d-sm-block' v-if='backToHome == false' v-on:click='backToHome = true'>Torna alla Home</Button>
                <button type='button' v-if='backToHome == false' class="create-home-mobile btn btn-danger d-sm-none" v-on:click='backToHome = true'>
                    <i class="fas fa-home"></i>
                </button>
                
                <div v-if='backToHome == true' class='backToHome'>
                    <p>Tornando alla home perderai il contenuto attuale nel tuo carrello, vuoi continuare comunque?</p>
                    <button type='button'><a href="{{route('guest-home')}}">Si</a></button>
                    <button v-on:click='backToHome = false'>No</button>
                </div>

                
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
            <div class="cart_icon">
                <button v-on:click='cartToggle' class='cart-button' type='button'>
                    <i class="fas fa-shopping-cart"></i>
                </button>
            </div>
            <div v-show="flag_cart && cartShow" class="form-group dish">
                <div v-for="(quantity, index) in quantity_dish" v-if="quantity_dish[index] > 0">
                    <span>@{{names_dish[index]}} :</span>
                    {{-- <label for="quantity[]">quantità</label> --}}
                    <input class='plate' type="number" id="quantity_cart" name="quantity[]" :value="quantity_dish[index]" readonly>
                </div>

                
                

                <div>
                    <label for="delivery">Spese di consegna €</label>
                    <input id='consegna'type="number" value=3.00 name="delivery" v-model="delivery" readonly>
                </div> 
                
                
                    <button type="button" class="btn btn-success" v-on:click="hiddenCart, flag_cart = false, cartShow = false">Procedi al pagamento</button>
                
        
            </div>
            

            <form action="/guest/payment" method="GET">
                <div v-show="!flag_cart && !cartShow " class="form-group">
                    <div class="form-group">
                        <label>Nome e Cognome</label>
                        <input type="text" name="customer_name" class="form-control" id="exampleFormControlInput1" placeholder="Mario Rossi" v-model='nomeCognome' required max="255" min='1'>
                    </div>
                    <div class="form-group">
                        <label>Indirizzo email</label>
                        <input type="email" name="customer_email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" v-model='indirizzoMail' required max="255" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$" min='1'>
                    </div>
                    <div class="form-group">
                        <label>Inserisci il tuo indirizzo</label>
                        <input type="text" name="customer_address" class="form-control" id="exampleFormControlInput1" v-model='indirizzo' required max="255" min='1'>
                    </div>
                    <div class="form-group">
                        <label>Numero di telefono</label>
                        <input type="text" name="customer_phone" class="form-control" id="exampleFormControlInput1" value="+39" v-model='numeroTelefono' required pattern="[0-9]{10}">
                    </div>
                    <div class="form-group my-hidden">
                        <input type='hidden' name="status" class="form-control" :value="payment_status" required>
                        <input type='hidden' name="user_slug" class="form-control" value="{{$data['user_slug']}}">
                        <input type='hidden' name="user_id" class="form-control" value="{{$data['user_id']}}">
                        <input type="hidden" name="amount" class="form-control" :value="amount" >
                        @php
                            $counter = 0;
                        @endphp
                        @foreach ($data['dishes'] as $index => $dish)
                            @if ($dish->visibility == 1)                   
                                <input type="hidden" name="dish_id[]" class="form-control" value="{{ $dish->id }}">
                                <input type='hidden' name="quantity[]" class="form-control" :value="quantity_dish[{{$counter}}]" readonly>
                                @php
                                    $counter += 1;
                                @endphp
                            @endif
                        @endforeach
                    </div>
                    {{-- <button type="button" v-on:click="payment" class="btn btn-success"> Paga
                    </button> --}}
                    {{-- <a href="/payment" class="btn btn-success"> Paga </a> --}}
                    <button type="submit" class="btn btn-success"> Paga </button>
                    <button v-on:click="flag_cart = true , cartShow = true"class='btn btn-success'>Torna al carrello</button>
                </div>
            </form>

        </div>
        
    </div>
        
    
            {{-- FINE CARRELLO --}}
</div>
@endsection

