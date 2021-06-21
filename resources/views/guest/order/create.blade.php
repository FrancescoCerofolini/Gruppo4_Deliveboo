@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xs-6">
           {{-- <form action="{{ route('order.store') }}" method="post">
                @csrf

                <div class="form-group my-hidden">
                    <label>Ristorante</label>
                    <input type="text" name="user_id" class="form-control" value="{{$user_id}}">
                </div> --}}
                {{-- CARRELLO --}}
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
 
                    {{-- @endforeach --}}

                    

                    <button type="button" class="btn btn-success" v-on:click="hiddenCart">procedi al pagamento</button>
                    
                </div>
                {{-- DATI UTENTE --}}
                

                <div v-if="flag_cart == false" class="form-group">

                    <div class="form-group">
                        <label>Nome e Cognome</label>
                        <input type="text" name="customer_name" class="form-control" id="exampleFormControlInput1" placeholder="Mario Rossi" v-model='nomeCognome'>
                    </div>
                    <div class="form-group">
                        <label>indirizzo email</label>
                        <input type="email" name="customer_email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" v-model='indirizzoMail'>
                        
                    </div>
                    <div class="form-group">
                        <label>inserisci il tuo indirizzo</label>
                        <input type="text" name="customer_address" class="form-control" id="exampleFormControlInput1" v-model='indirizzo'>
                    </div>
                    <div class="form-group">
                        <label>numero di telefono</label>
                        <input type="text" name="customer_phone" class="form-control" id="exampleFormControlInput1" value="+39" v-model='numeroTelefono'>
                    </div>
    
                    <div class="form-group my-hidden">
                        <label>status</label>
                        <input type='hidden' name="status" class="form-control"  :value="payment_status">
                    </div>

                    <button type="button" v-on:click="payment" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Paga
                    </button>
    

                    

                </div>
            </form>
        </div>
        <div class="col-xs-6">
            <form action="{{ route('order.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <h1>Ordine da {{ strtoupper(str_replace('-', ' ', $user_slug)) }}</h1>
                <label>Ristorante</label>
                    <input type="hidden" name="user_id" class="form-control" value="{{$user_id}}">

                @foreach ($dishes as $dish)
                    <div class="form-group">
                        <label>
                            <h3 class="name_dish">{{ucfirst($dish->name)}}</h3>
                            <h4>{{$dish->description}}</h4>
                            <h5>Prezzo :<span class="price">{{$dish->price}}</span></h5>                            
                        </label>

                        <input type="hidden" name="dish_id[]" class="form-control" value="{{ $dish->id }}">
                        <input type="number" name="quantity[]" id="quantity" class="quantity form-control @error('quantity') is-invalid @enderror" value="0" v-on:change="amountFunction" required min="0">
                        
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        
                    </div>
                @endforeach
                <input type='hidden' name="customer_name" class="form-control" :value="(nomeCognome == '') ? 'placeholder' : nomeCognome">
                <input type='hidden' name="customer_address" class="form-control" :value="(indirizzo == '') ? 'placeholder' : indirizzo">
                <input type='hidden'name="customer_email" class="form-control" :value="(indirizzoMail == '') ? 'placeholder' : indirizzoMail">
                <input type='hidden'name="customer_phone" class="form-control" :value="(numeroTelefono == '') ? 'placeholder' : numeroTelefono">
                <input type='hidden' name="status" class="form-control" id="status" value="" readonly>
                <input name="amount" class="form-control" id="amount" v-model="amount" readonly>

                {{-- Bottoni pagamento nel form di blade --}}
                
                <div class="form-group my-hidden">
                    <button id='tiodio' type="submit">Automatico</button>
                </div>

            </form>
            
        </div>
    </div>
</div>
@endsection
