@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 table_padding">
            <div class="d-flex justify-content-between align-items-center table_title">
                <h1>Ordini ricevuti</h1>
            </div>
            <div class="panel">
                <div class="panel-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Codice ordine</th>
                                <th>Data richiesta ordine</th>
                                <th class="text-center">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr class="row_on_hover">
                                <td>{{ $order->code }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td class="text-center">
                                    <ul class="action-list">
                                        <li>
                                            <a href="{{ route('admin.order.show', $order->id)}}" data-tip="visualizza"><i class="fas fa-eye"></i></a>
                                        </li>                                        
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection