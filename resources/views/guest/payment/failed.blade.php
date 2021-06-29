@extends('layouts.app')

@section('content')
<div class="container">
    <div class=" margin-top-100 ">
        <div class="min-50-vh">
            <div class="row">
            <div class=" col-8 col-xs-8 col-md-12 col-lg-12">
                <h3>Oops! Sembra che qualcosa non sia andato come sperato </h3>
            </div>
        </div>
        <div class="row">

            <div class="col-8 col-xs-8 col-md-12">
                
                <h5>La tua transazione è stata rifiutata </h5>
                <p>Per Favore la preghiamo di ritentare il pagamento</p>
                <form action="{{asset('guest/order/create?user_id=' . $data['user_id'] . '&user_slug=' . $msUser->slug)}}" method="get">
                    <input type="hidden" name='user_slug' value='{{$msUser->slug}}'>
                    <input type="hidden" name='user_id' value='{{$data['user_id']}}'>
                    @foreach ($data['quantity'] as $quantity)
                    <input type="hidden" name='quantity[]' value='{{$quantity}}'>
                    @endforeach               
                    
                    <button class="btn btn-success justify-content-center" type='submit'>Riprova il pagamento</button>
                </form>
            </div>
        </div>
        </div>
    </div>    
</div> 
        
@endsection
