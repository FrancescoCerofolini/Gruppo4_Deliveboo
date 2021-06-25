@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="row">
               <div class="col-xs-12">
                    <br>
                    <br>
                    <br>
                    <h1>Pagamento accettato</h1>
                    <h3>{{$request['customer_name']}}</h3>
                    <h3>{{$request['customer_email']}}</h3>
                    <h3>{{$request['customer_address']}}</h3>
                    <h3>{{$request['customer_phone']}}</h3>

                    <h3>{{$request['user_slug']}}</h3>
                    <h3>{{$request['user_id']}}</h3>
                    <h3>{{$request['names_dish']}}</h3>
                    <h3>{{$request['amount']}}</h3>
                    <h3>{{$request['quantity_dish']}}</h3>

                    <form class='ms-create-dish' action="{{ route('order.store') }}" method="post" enctype="multipart/form-data">
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
                            
                            <input type="text" name="amount" value="{{$request['amount']}}">
                            
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
        
                        <Button class='btn btn-danger create-home d-none  d-md-block' v-if='backToHome == false' v-on:click='backToHome = true'>Torna alla Home</Button>
                        <button type='button' v-if='backToHome == false' class="create-home-mobile btn btn-danger d-md-none" v-on:click='backToHome = true'>
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
    </div>
    <script>
        
    </script>   
@endsection
