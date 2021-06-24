<header>
    {{-- navbar --}}
    <div class="my-navbar">
        <div class="row">

            <div class="col-4 col-md-4 logo">
                <a href="{{ route('guest-home') }}">
                    <img src="{{ asset('img/DeliveBoo_logo.png') }}" alt="DeliveBoo logo">
                </a>
            </div>

            <div class="col-4 col-md-4 text-center">
                <i class="fas fa-map-marker-alt"></i>
                <span>Milano</span>
            </div>

            @if (Route::has('login'))
                <div class="col-4 col-md-4 text-right">
                    @auth
                        <a href="{{ url('/admin') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

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