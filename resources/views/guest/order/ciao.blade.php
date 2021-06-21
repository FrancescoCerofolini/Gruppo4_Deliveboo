@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="row">
            <a href="{{asset('guest/order/create?user_id=' . $data['user_id'] . '&user_slug=' . $msUser->slug)}}">riprova il pagamento</a>  
        </div>
    </div>    
@endsection
