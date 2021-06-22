<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Deliveboo Home</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div id='app' class="flex-center position-ref full-height">

            <div class="content">
                <header>
                    {{-- navbar --}}
                    <div class="my-navbar">
                        <div class="row">
    
                            <div class="col-xs-4 col-md-4 logo">
                                <a href="{{ route('guest-home') }}">
                                    <img src="{{ asset('img/DeliveBoo_logo.png') }}" alt="DeliveBoo logo">
                                </a>
                            </div>
    
                            <div class="col-xs-3 col-md-4 text-center">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Milano</span>
                            </div>
    
                            @if (Route::has('login'))
                                <div class="col-xs-5 col-md-4 text-right">
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
                </header>
                {{-- Fine NavBar --}}

                <div class="container-fluid text-center">

                    {{-- selezione categoria --}}
                    <div v-if='selected_category == ""' class="categories">
                        <button type='sumbit' class="btn-categoria" v-on:click='getRestaurants(category)'
                            v-for='(category,index) in categories'>@{{category.name}}</button>
                    </div>
                    
                    {{-- searchbar per nome ristorante --}}
                    <div v-if='selected_category != ""' class="searchbar cerca-ristorante">
                        <form action="" method=''>
                            <input v-if='flag != false' v-on:keyup.enter='searchResults' v-model='searchFilter' placeholder='Trova il tuo ristorante' type="text" onkeydown="return event.key != 'Enter';">
                            <input v-if='flag != false' v-on:click='searchResults' type="button" value='Cerca'>
                            <input v-on:click='selected_category = ""' type="button" value='Torna alle categorie'>
                            <input v-if='flag == false' v-on:click='resetRestaurants' type="button" value='Torna ai ristoranti'>
                        </form>
                    </div>
                    
                    <h2 class='category'>@{{ selected_category }}</h2>

                    {{-- selezione ristorante --}}
                    <div class="ristoranti">
                        <span v-if='flag != false && selected_category != ""' v-for='(restaurant, index) in restaurants'>
                            <form action="{{ route('order.create')}}" method="get" class="in-linea">
                                <div class=" form-group my-hidden">
                                    <input name="user_id" type="text" :value="(restaurant.user_id != '') ? restaurant.user_id : 'default'">
                                    <input name="user_slug" type="text" :value="(restaurant.slug != '') ? restaurant.slug : 'default'">
                                </div>
                                <button type="submit" class="btn-ristorante"> @{{ restaurant.slug.charAt(0).toUpperCase() + restaurant.slug.slice(1).replace('-', ' ') }}</button>
        
                            </form>
                        </span>
                        <span v-for='(element, index) in collection' v-if='flag == false && selected_category != ""'>
                            <form action="{{ route('order.create')}}" method="get">
                                <div class=" form-group my-hidden">
                                    <input name="user_id" type="text" :value="(element.user_id != '') ? element.user_id : 'default'">
                                    <input name="user_slug" type="text" :value="(element.slug != '') ? element.slug : 'default'">
                                </div>
                                <button type="submit">@{{element.slug.replace('-', ' ') }}</button>
        
                            </form>
                        </span>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>