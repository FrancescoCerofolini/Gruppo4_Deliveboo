@extends('layouts.app')

@section('content')
<div class="banner register">
    <img class="img_banner" src="http://slidesigma.com/themes/html/foodmart/assets/img/banner/banner-4.jpg" alt="">
    <div class="overlay"></div>

    <div class="container form_banner">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-7 align-self-center">
                <div class="text_bunner mb-5">
                    <h1 class="mb-4">Incrementa le tue vendite del 50%</h1>
                    <h3>iniziando ad usufruire del servizio di <span>DELIVEBOO</span></h3>
                </div>
            </div>

            <div class="col-sm-12 col-md-5">
                
                <div class="card">
                    <div class="card-header text-center">{{ __('Registrati') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
    
                            <div class="form-group row">
    
                                <div class="col-lg-12">
                                    <input placeholder="nome ristorante" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
    
                                <div class="col-lg-12">
                                <input placeholder="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
    
                                <div class="col-lg-12">
                                    <input placeholder="indirizzo ristorante" id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
    
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
    
                                <div class="col-lg-12">
                                    <input placeholder="partita Iva" id="piva" type="text" class="form-control @error('piva') is-invalid @enderror" name="piva" value="{{ old('piva') }}" required autocomplete="piva" autofocus>
    
                                    @error('piva')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
    
                                <div class="col-lg-12">
                                    <input placeholder="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
    
                                <div class="col-lg-12">
                                    <input placeholder="conferma password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn_orange w-100">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</div>



@endsection
