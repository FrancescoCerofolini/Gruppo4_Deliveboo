@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12">
            <form action="{{ route('order.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group my-hidden">
                    <label>Ristorante</label>
                    <input type="text" name="user_id" class="form-control" value="{{$user_id}}">
                </div>

                @foreach ($dishes as $dish)
                    <div class="form-group">
                        <label>
                            <h3>{{$dish->name}}</h3>
                            <h4>{{$dish->description}}</h4>
                            <h5>Prezzo :<span class="price">{{$dish->price}}</span></h5>                            
                        </label>
                        
                        <input type="number" name="quantity[]" class="quantity form-control @error('quantity') is-invalid @enderror" value="0" @change="amountFunction" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
                     
                <div class="form-group">
                    <label>Nome e Cognome</label>
                    <input type="text" name="customer_name" class="form-control" id="exampleFormControlInput1" placeholder="Mario Rossi">
                </div>
                <div class="form-group">
                    <label>indirizzo email</label>
                    <input type="email" name="customer_email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    
                </div>
                <div class="form-group">
                    <label>inserisci il tuo indirizzo</label>
                    <input type="text" name="customer_address" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                    <label>numero di telefono</label>
                    <input type="text" name="customer_phone" class="form-control" id="exampleFormControlInput1" value="+39">
                </div>

                <div class="form-group my-hidden">
                    <label>status</label>
                    <input name="status" class="form-control" id="status" :value="payment_status">
                </div>

                <div class="form-group">
                    <input name="amount" class="form-control" id="amount" v-model="amount" readonly>
                </div>
                
                <button type="button" v-on:click="payment" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Paga
                </button>

                <div class="form-group my-hidden">
                    <button id='tiodio' type="submit">Automatico</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection
