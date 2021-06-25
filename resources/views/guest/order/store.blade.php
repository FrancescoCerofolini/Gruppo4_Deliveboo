@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="row">
               <div class="col-xs-12">
                    

                    <form class='ms-create-dish' action="{{ route('order.store') }}" method="get" enctype="multipart/form-data">
                        
                        
                        <br>
                        <br>
                        <br>
                        <h1>Pagamento accettato</h1>
                        <input value="{{$request['customer_name']}}">
                        <input value="{{$request['customer_email']}}">
                        <input value="{{$request['customer_address']}}">
                        <input value="{{$request['customer_phone']}}">
                        <input value="{{$request['user_slug']}}">
                        <input value="{{$request['user_id']}}">
                        <input value="{{$request['names_dish']}}">
                        <input value="{{$request['amount']}}">
                        <input value="{{$request['quantity_dish']}}">
                        {{-- <div class="form-group my-hidden"> --}}
                            <button id='ordine' type="submit">Automatico</button>
                        {{-- </div> --}}
                    </form>

               </div>
        </div>
    </div>
    <script>
        // document.getElementById('ordine').click();
    </script>   
@endsection
