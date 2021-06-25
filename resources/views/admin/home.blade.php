@extends('layouts.dashboard')

@section('content')

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    

                    @foreach ($user as $value)
                        <p>Bentornato <strong>{{$value->name}}</strong>!</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            @foreach ($user as $value)
                <h1 class="text-center">Bentornato <strong>{{$value->name}} !</strong></h1>
            @endforeach
        </div>

        <div class="col-sm-12">
            <h2 class="text-center my-5">RIEPILOGO</h2>
        </div>

        <div class="col-md-6 col-sm-12 block_recap">
            @foreach ($tot_orders as $tot_order)
                <h3 class="text-center">Ordini totali: <strong>{{$tot_order->tot_order}}</strong></h3>
            @endforeach
        </div>

        <div class="col-md-6 col-sm-12 block_recap">
            @foreach ($tot_dishes as $tot_dish)
                <h3 class="text-center">Totale piatti del ristorante: <strong>{{$tot_dish->tot_dish}}</strong></h3>
            @endforeach
        </div>

        <div class="col-sm-12 block_recap">
            @foreach ($tot_amounts as $tot_amount)
                <h3 class="text-center">Totale soldi guadagnati: <strong>{{$tot_amount->tot_amount}} €</strong></h3>
            @endforeach
        </div>

    </div>

</div>
@endsection
