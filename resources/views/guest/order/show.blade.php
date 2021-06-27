@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                        
                        <br>
                        <br>
                        <br>
                        <h1>Pagamento accettato</h1>
                        
                        <h2>Riepilogo Ordine</h2>

                        <h4>Nome: {{$customer_name}}</h4>
                        <h4>Email: {{$customer_email}}</h4>
                        <h4>Indirizzo di consegna: {{$customer_address}}</h4>
                        <h4>Telefono: {{$customer_phone}}</h4>
                        <h4>Ristorante: {{$user_slug}}</h4>
                        
                        <h4>Prezzo Totale: {{$amount}}</h4>
            </div>
        </div>
    </div>