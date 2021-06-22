@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{asset('guest/order/create?user_id=' . $data['user_id'] . '&user_slug=' . $msUser->slug)}}" method="get">
                <input type="hidden" name='user_slug' value='{{$msUser->slug}}'>
                <input type="hidden" name='user_id' value='{{$data['user_id']}}'>
                @foreach ($data['quantity'] as $quantity)
                <input type="hidden" name='quantity[]' value='{{$quantity}}'>
                @endforeach               


                <button type='submit'>Riprova il pagamento</button>
            </form>
        </div>
    </div>    
@endsection