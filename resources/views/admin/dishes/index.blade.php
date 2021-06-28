@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 table_padding">
            <div class="d-flex justify-content-between align-items-center table_title">
                <h1>I tuoi piatti</h1>
                <span>
                    <a href="{{ route('admin.dish.create') }}" class="btn_orange">
                        Crea nuovo piatto
                    </a>
                    <a href="{{ route('admin.dish.create') }}">
                        <i class="fas fa-plus-square"></i>
                    </a>
                </span>
            </div>
            <div class="panel">
                <div class="panel-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrizione</th>
                                <th class="text-center">Prezzo</th>
                                <th class="text-center">Visibilit&Agrave;</th>
                                <th class="text-center">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dishes as $dish)
                            <tr class="row_on_hover">
                                <td>{{ $dish->name }}</td>
                                <td>{{ $dish->description }}</td>
                                <td class="text-center">{{ $dish->price }} &euro;</td>
                                <td class="text-center">{{ $dish->visibility }}</td>
                                <td class="text-center">
                                    <ul class="action-list">
                                        <li>
                                            <a href="{{ route('admin.dish.edit', $dish->id) }}"" data-tip="modifica"><i class="fa fa-edit"></i></a>
                                        </li>
                                        <li>
                                            <form class="d-inline-block form_elimina" action="{{ route('admin.dish.destroy', $dish->id) }}" method="post" data-tip="elimina">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
