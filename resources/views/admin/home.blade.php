@extends('layouts.dashboard')

@section('content')

<div class="container">
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
                    <p>{{-- inserire data e ora --}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
