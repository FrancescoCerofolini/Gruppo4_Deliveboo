@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center table_title">
                <h1>Dettaglio ordine</h1>
            </div>
            <div class="panel">
                <div class="panel-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>indirizzo</th>
                                <th>email</th>
                                <th>telefono</th>
                                <th>nome</th>
                                <th>codice ordine</th>
                                <th>status</th>
                                <th>totale</th>
                                <th>data</th>
                                <th>piatti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>{{ $order->customer_address }}</td>
                            <td>{{ $order->customer_email }}</td>
                            <td>{{ $order->customer_phone }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->code }}</td>
                            <td class="text-center">{{ $order->status }}</td>
                            <td class="text-center">{{ $order->amount }} &euro;</td>
                            <td>{{ $order->created_at }}</td>
                            <td class="list_dish">
                                <ul>
                                    @foreach ($dishes as $dish)
                                        <li>{{$dish->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection