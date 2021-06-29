@extends('layouts.app')

@section('content')
{{-- @dd($dish_names) --}}

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Pagamento accettato</h1>
                <h2>Dati Cliente</h2>

                <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Cellulare</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">{{$customer_name}}</th>
                    <td>{{$customer_email}}</td>
                    <td>{{$customer_address}}</td>
                    <td>{{$customer_phone}}</td>
                    </tr>
                    
                </tbody>
                </table>
                <h4>Riepilogo Ordine :</h4>
                <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Piatto</th>
                        <th scope="col">Quantità</th>
                        <th scope="col">Prezzo</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    @foreach ($dish_id as $index => $item)
                    @if ($quantity[$index] > 0)
                    <th scope="row">
                        {{ucfirst($dish_names[$index][0]->name)}}
                    </th>
                    <td>
                        {{$quantity[$index]}}
                    </td>
                    <td>
                        {{$dish_names[$index][0]->price * $quantity[$index]}} €                    
                    </td>

                    </tr>
                    @endif
                    @endforeach
                </tbody>
                </table>   
                <h4>Spese di Consegna: 3 €</h4>                      
                <h4>Prezzo Totale: {{$amount}} €</h4>
                <p>Grazie per averci scelto, il tuo ordine sarà recapitato il prima possibile all'indirizzo indicato. Buon Appetito e alla prossima dal team di Deliveboo</p>
            </div>
        </div>
    </div>