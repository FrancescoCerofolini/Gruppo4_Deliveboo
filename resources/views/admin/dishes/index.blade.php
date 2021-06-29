@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center table_title">
                <h1>I tuoi piatti</h1>
                <a href="{{ route('admin.dish.create') }}" class="btn_orange">
                    Crea nuovo piatto
                </a>
            </div>
            <div class="panel">
                <div class="panel-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Descrizione</th>
                                <th class="text-center">Prezzo</th>
                                <th class="text-center">Visibilit&Agrave;</th>
                                <th class="text-center">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $Mtmp = [];                                                         
                            @endphp
                            @foreach ($dishes as $index => $dish)
                            <?php $tmp = [] ?> 
                            <?php $tmp [] = $dish->name ?>
                            <?php $tmp [] = $dish->id ?>
                            <?php $tmp [] = $dish->description ?>
                            <?php $tmp [] = $pushdish->price ?>
                            <?php $tmp [] = $dish->visibility ?>
                            @php
                            $Mtmp [] = $tmp;
                            @endphp
                            @endforeach
                            @php
                            function compareByName($a, $b) {
                            return strcmp($a[0], $b[0]);
                            }
                            usort($Mtmp, 'compareByName');
                            // dd($Mtmp)
                            @endphp
                            @foreach ($Mtmp as $dish)
                            <tr class="row_on_hover">
                                <td>{{ $dish[1] }}</td> {{-- ID --}}
                                <td>{{ $dish[0] }}</td> {{-- nome --}}
                                <td>{{ $dish[2] }}</td> {{-- descrizione --}}
                                <td class="text-center">{{ $dish[3] }} &euro;</td> {{-- prezzo --}}
                                <td class="text-center">{{ $dish[4] }}</td> {{-- visibilità --}}
                                <td class="text-center">
                                    <ul class="action-list">
                                        <li>
                                            <a href="{{ route('admin.dish.edit', $dish[1]) }}" data-tip="modifica"><i class="fa fa-edit"></i></a>
                                        </li>
                                        <li>
                                            <form class="d-inline-block form_elimina" action="{{ route('admin.dish.destroy', $dish[1]) }}" method="post" data-tip="elimina">
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
                            {{-- @dd($Mtmp) --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
