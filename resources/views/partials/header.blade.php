<header>
    {{-- navbar --}}
    <div class="my-navbar">
        {{-- <div class="row">

            <div class="col-4 col-md-4 logo">
                <a href="{{ route('guest-home') }}">
                    <img src="{{ asset('img/DeliveBoo_logo.png') }}" alt="DeliveBoo logo" id="logo_big">
                    <img src="{{ asset('img/DeliveBoo_logo_small.png') }}" alt="DeliveBoo logo small" id="logo_small">
                </a>
            </div>

            <div class="col-4 col-md-4 text-center">
                <div id="city">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Milano</span>
                </div>

                <nav class="navbar navbar-expand-lg navbar-light bg-light city_menu">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerCity"
                        aria-controls="navbarTogglerCity" aria-expanded="false" aria-label="Toggle city">
                        <i class="fas fa-map-marker-alt"></i>
                    </button>
                
                    <div class="collapse navbar-collapse" id="navbarTogglerCity">
                        <div class="navbar-nav pr-3">
                            
                            <a href="{{ route('guest-home') }}" class="nav-item nav-link">
                                <span id="Milano">Milano</span>
                            </a>
                            
                            <a href="#" class="nav-item nav-link inactive_link">
                                <span id="Roma" class="nav-item nav-link">Roma</span>
                            </a>
    
                            <a href="#" class="nav-item nav-link inactive_link">
                                <span id="Bologna" class="nav-item nav-link">Bologna</span>
                            </a>
                
                        </div>
                    </div>
                </nav>
            </div>


            @if (Route::has('login'))
                <div class="col-4 col-md-4 text-right">
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
                    <nav class="navbar navbar-expand-lg navbar-light bg-light hamburger_menu">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerHamburger"
                            aria-controls="navbarTogglerHamburger" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-bars"></i>
                        </button>
                    
                        <div class="collapse navbar-collapse" id="navbarTogglerHamburger">
                            <div class="navbar-nav text-right pr-3">                        
                                @auth
                                    <a href="{{ url('/admin') }}" class="nav-item nav-link">Home</a>
                                    @else
                                    <a href="{{ route('login') }}" class="nav-item nav-link">
                                        <span id="login">Login</span>
                                    </a>
                                    
                                    @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="nav-item nav-link">Registrati</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </nav>
                </div>
            @endif
        </div> --}}

        {{-- <div class="row"> --}}
        
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