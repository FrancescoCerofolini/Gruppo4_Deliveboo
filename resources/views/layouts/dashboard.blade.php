<!doctype html>
@foreach ($user as $value)
    {{$value->name}}
@endforeach
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('chart.js/chart.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body id="body" >
    {{-- <nav class="navbar navbar-expand-md navbar-dark bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Deliveboo</a>
        <ul class="navbar-nav px-3 ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('guest-home') }}">
                    Visita il sito
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav> --}}
    {{-- @include('partials.header') --}}
    <div class="container-fluid p-0" id="dashboard">
        <div class="row">
            <nav id="nav_left">
                <div class="menu_nav_left">
                    <img class="logo" src="{{ asset('img/DeliveBoo_logo.png') }}" alt="DeliveBoo logo">
                    <ul class="nav flex-column menu_dashboard">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('admin-home')}}">
                                <i class="fas fa-home"></i>
                                <span class="mobile_hidden">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dish.index') }}">
                                <i class="fas fa-utensils"></i>
                                <span class="mobile_hidden">Piatti</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.order.index')}}">
                                <i class="fas fa-clipboard-list"></i>
                              <span class="mobile_hidden">Storico Ordini</span>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin-statistics')}}">
                                <i class="fas fa-chart-line"></i>
                              <span class="mobile_hidden">Statistiche</span>
                            </a>
                        </li>
                        <li class="nav-item">
                        </li>
                    </ul>
                    <div class="menu_user">
                        <a class="nav-link logout" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <a class="nav-link logout_i" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <hr>

                        <div class="user">
                            <div class="img_user">
                                <i class="fas fa-user"></i>
                            </div>
                            
                            <span class="mobile_hidden">{{$value->name}}</span>
                        </div>
                        
                    </div>
                </div>
            </nav>

            <main role="main">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
