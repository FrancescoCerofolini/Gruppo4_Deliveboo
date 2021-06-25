<header>
    {{-- navbar --}}
    <div class="my-navbar">
        <div class="row">

<<<<<<< HEAD
            <div class="col-4 col-md-4 logo">
=======
            <div class="col-3 col-md-4 logo">
>>>>>>> remotes/origin/michela
                <a href="{{ route('guest-home') }}">
                    <img src="{{ asset('img/DeliveBoo_logo.png') }}" alt="DeliveBoo logo" id="logo_big">
                    <img src="{{ asset('img/DeliveBoo_logo_small.png') }}" alt="DeliveBoo logo small" id="logo_small">
                </a>
            </div>

            <div class="col-2 col-md-4 text-center">
                <i class="fas fa-map-marker-alt"></i>
                <span id="city">Milano</span>
            </div>

            @if (Route::has('login'))
                <div class="col-7 col-md-4 text-right">
                    @auth
                        <a href="{{ url('/admin') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">
                            <span id="login">Login</span>
                            <i class="fas fa-sign-in-alt"></i>
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registrati</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
    {{-- Fine NavBar --}}
</header>