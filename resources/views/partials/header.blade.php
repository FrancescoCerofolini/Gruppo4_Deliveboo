@if (!Request::is('guest/order/create*'))
<header>
@else
    <header id='not-valid'>
@endif

    {{-- navbar --}}
    <div class="my-navbar">

            <div class="header-left">
                <a href="{{ route('guest-home') }}">
                    <img src="{{ asset('img/DeliveBoo_logo.png') }}" alt="DeliveBoo logo" id="logo_big">
                    <img src="{{ asset('img/DeliveBoo_logo_small.png') }}" alt="DeliveBoo logo small" id="logo_small">
                </a>
            </div>
        
            <div class="header-center-container">
                <div id="city">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Milano</span>
                </div>
        
                <div id="city-marker">
                    <i class="fas fa-map-marker-alt" v-on:click="cityMenu()"></i>
                    <div id="city-menu-container">
                    
                        <div id="city-menu" class="hidden">
                            <a href="{{ route('guest-home') }}" class="active_link">
                                <span id="Milano">Milano</span>
                            </a>
                    
                            <a href="#" class="inactive_link">
                                <span id="Roma">Roma</span>
                            </a>
                    
                            <a href="#" class="inactive_link">
                                <span id="Bologna">Bologna</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
                
            @if (Route::has('login'))
            <div class="header-right-container">
                <div class="header_right">
                    @auth
                        <a href="{{ url('/admin') }}">Home</a>
                        @else
                        <a href="{{ route('login') }}">
                            <span id="login">Login</span>
                        </a>
            
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}">Registrati</a>
                        @endif
                    @endauth
                </div>
                
                <i class="fas fa-bars" v-on:click="hamburgerMenu()"></i>
                <div class="hamburger-menu-container text-right">
        
                    <div id="hamburger-menu" class="text-left hidden">
                        @auth
                            <a href="{{ url('/admin') }}">Home</a>
                            @else
                            <a href="{{ route('login') }}">
                                <span id="login">Login</span>
                            </a>
        
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registrati</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            @endif
        {{-- </div> --}}
    </div>
    {{-- Fine NavBar --}}
</header>