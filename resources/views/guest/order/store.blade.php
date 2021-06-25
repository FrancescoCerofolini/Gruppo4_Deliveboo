@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="row">
               <div class="col-xs-12">
                    <br>
                    <br>
                    <br>
                    <h1>Pagamento accettato</h1>
                    <h3>{{$request['customer_name']}}</h3>
                    <h3>{{$request['customer_email']}}</h3>
                    <h3>{{$request['customer_address']}}</h3>
                    <h3>{{$request['customer_phone']}}</h3>

                    <h3>{{$request['user_slug']}}</h3>
                    <h3>{{$request['user_id']}}</h3>
                    <h3>{{$request['amount']}}</h3>

                    
                    <form {{-- class='ms-create-dish' --}} action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- $method="POST"; --}}
                        
                        @php
                            $counter = 0;
                        @endphp
                        @foreach ($request['dish_id'] as $dish)
                            <input name="dish_id[]" value="{{$request['dish_id'][$counter]}}">
                            <input name="quantity[]" value="{{$request['quantity'][$counter]}}">
                            @php
                                $counter += 1;
                            @endphp
                        @endforeach

                        <input name="customer_name" value="{{$request['customer_name']}}">
                        <input name="customer_email" value="{{$request['customer_email']}}">
                        <input name="customer_address" value="{{$request['customer_address']}}">
                        <input name="customer_phone" value="{{$request['customer_phone']}}">

                        <input name="amount" value="{{$request['amount']}}">
                        
                        <div class="form-group">
                            <button id="orderStore" type="submit">Automatico</button>
                        </div>
        
                    </form>

               </div>
        </div>
    </div>
    <script>
        //document.getElementById('orderStore').click();
    </script>   
@endsection
