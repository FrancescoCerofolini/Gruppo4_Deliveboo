@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12">
            <form action="{{ route('order.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    @foreach ($dishes as $dish)
                        <label>{{$dish->name}}</label>
                        <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="0" required>
                    @endforeach
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    {{-- <label>Nome piatto</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Inserisci il titolo" value="{{ old('name') }}" required>
                    <label>Prezzo</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Inserisci il titolo" value="{{ old('price') }}" required> --}}
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Crea piatto
                    </button>
                </div>
            </form>
            @foreach ($dishes as $dish)
                <h2>{{$dish->name}}</h2>
            @endforeach
        </div>
    </div>
</div>
@endsection
