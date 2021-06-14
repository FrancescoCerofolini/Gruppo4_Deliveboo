@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Creazione nuovo piatto</h1>
                <a href="{{ route('admin.dish.index') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg> Tutti i dish
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
            <form action="{{ route('admin.dish.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nome piatto</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Inserisci il titolo" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label>Prezzo</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Inserisci il titolo" value="{{ old('price') }}" required>
                </div>
                <div class="form-group">
                    <label>Allergeni</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="10" placeholder="Inizia a scrivere qualcosa..." required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label for="visibility">Disponibile</label>
                    <input type="checkbox" name="visibility" id="" value="1">
                </div>
                {{-- <div class="form-group">
                    <label>Categoria</label>
                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                        <option value="">-- seleziona categoria --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected=selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}
                {{-- <div class="form-group">
                    <p>Seleziona i tag:</p>
                    @foreach ($tags as $tag)
                        <div class="form-check @error('tags') is-invalid @enderror">
                            <input name="tags[]" class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                            {{ in_array($tag->id, old('tags', [])) ? 'checked=checked' : '' }}>
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Crea piatto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
