@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Dettaglio ordine</h1>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>customer address</th>
                        <th>customer email</th>
                        <th>customer phone</th>
                        <th>customer name</th>
                        <th>code</th>
                        <th>status</th>
                        <th>amount</th>
                        <th>date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->customer_address }}</td>
                        <td>{{ $order->customer_email }}</td>
                        <td>{{ $order->customer_phone }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->code }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->amount }}</td>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection