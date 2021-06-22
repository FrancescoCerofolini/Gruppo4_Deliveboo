@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Modifica piatto :  {{ $dish->name }}</h1>
                <a href="{{ route('admin.dish.index') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg> Tutti i piatti
                </a>
            </div>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <form action="{{ route('admin.dish.update', ['dish' => $dish->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nome piatto</label>
                    <input type="text" name="name" class="form-control @error('title') is-invalid @enderror" placeholder="Inserisci il titolo" value="{{ value( $dish->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <label>Prezzo</label>
                    <input type="number" name="price" step="0.01" class="form-control @error('price') is-invalid @enderror" value="{{ value( $dish->price) }}" required min="0.00" max="20.00">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Allergeni</label>
                    <textarea name="description" class="form-control @error('content') is-invalid @enderror" rows="10" placeholder="Inizia a scrivere qualcosa..." required max="255">{{ value($dish->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label for="visibility">Disponibile</label>
                    <select name="visibility" id="">
                        <option selected value="{{ value($dish->visibility)}}"> {{ $dish->visibility == 1 ? 'visibile' : 'non visibile'}}</option>
                        <option  value="{{ $dish->visibility == 1 ? 0 : 1}}"> {{ $dish->visibility == 1 ? 'non visibile' : 'visibile'}}</option>      
                    </select>
                    {{--<input type="checkbox" name="visibility" id="" {{ $dish->visibility == 1 ? 'checked=checked' : '' }} {{ 'checked=checked' ? value="{{$dish->visibility = 1}}" : value="{{ $dish->visibility = 0}}"}}  >--}}
                </div>
                {{-- <div class="form-group">
                    <p>Seleziona i tag:</p>
                    @foreach ($tags as $tag)
                        <div class="form-check @error('tags') is-invalid @enderror">
                            <input name="tags[]" class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                            {{ $dish->tags->contains($tag) ? 'checked=checked' : '' }}>
                            <label class="form-check-label">
                                {{ $tag->name }}
                            </label>
                        </div>
                    @endforeach
                    @error('tags')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Salva post
                    </button>
                </div> 
            </form>
        </div>
    </div>
</div>
@endsection