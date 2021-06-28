@extends('layouts.app')

@section('content')
{{-- @dd($dish_names) --}}

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Pagamento accettato</h1>
                <h2>Riepilogo Ordine</h2>
                <h4>Nome: {{$customer_name}}</h4>
                <h4>Email: {{$customer_email}}</h4>
                <h4>Indirizzo di consegna: {{$customer_address}}</h4>
                <h4>Telefono: {{$customer_phone}}</h4>
                <h4>Ristorante: {{ucfirst(str_replace('-', ' ', $user_slug))}}</h4>
                <h4>Riepilogo ordine : </h4>
                @foreach ($dish_id as $index => $item)
                    @if ($quantity[$index] > 0)
                        <p>- {{ucfirst($dish_names[$index][0]->name)}} x {{$quantity[$index]}} : {{$dish_names[$index][0]->price * $quantity[$index]}} €</p>
                    @endif                        
                @endforeach           
                
                <h4>Prezzo Totale: {{$amount}} €</h4>
            </div>
        </div>
    </div>