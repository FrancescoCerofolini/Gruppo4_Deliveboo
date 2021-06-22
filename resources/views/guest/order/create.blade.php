@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12">
            <form action="{{ route('order.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    {{-- ALLA FINE QUESTO FORM GRUOP DEVE ESSERE INVISIBILE --}}
                    <label>Ristorante</label>
                    <input type="text" name="user_id" class="form-control" value="{{$user_id}}">
                </div>
                @foreach ($dishes as $dish)
                    <div class="form-group">
                        <label>
                            <h3>Nome del piatto:{{$dish->name}}</h3>
                            <h4>{{$dish->description}}</h4>
                            <h5>Prezzo :{{$dish->price}}</h5>
                        </label>
                        
                        <input type="number" name="quantity[]" class="form-control @error('quantity') is-invalid @enderror" value="0" required min="0" max="10">
                        @error('quantity[]')
                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
                     
                <div class="form-group">
                    <label>Nome e Cognome</label>
                    <input type="text" name="customer_name" class="form-control" placeholder="Nome Cognome" required max="255">
                    @error('customer_name')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>indirizzo email</label>
                    <input type="email" name="customer_email" class="form-control"  placeholder="name@example.com" required max="255">
                    @error('customer_email')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>inserisci il tuo indirizzo</label>
                    <input type="text" name="customer_address" class="form-control" required max="255">
                    @error('customer_address')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>numero di telefono</label>
                    <input type="text" name="customer_phone" class="form-control" id="exampleFormControlInput1" value="+39" required pattern="^[+39]?[0-9]{12}$">
                    @error('customer_phone')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>status</label>
                    <input type="hidden" name="status" class="form-control" id="status" :value="payment_status" readonly>
                </div>
                
                <button type="button" v-on:click="payment">BOTTONE DA CLICCARE</button>

                <div class="form-group">
                    <button id='tiodio' {{-- v-on:click="payment" :type="(payment_status == 'SUBMITTED_FOR_SETTLEMENT') ? 'submit' : 'button'" --}} type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Crea piatto (PARTE DA SOLO)
                    </button>
                </div>
            </form>
            {{-- <button type="button" v-on:click="payment">prova</button> --}}
            
        </div>
    </div>
</div>
@endsection
