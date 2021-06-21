<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Deliveboo Home</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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
    
                            <div class="col-xs-4 col-md-4 logo debug">
                                <a href="{{ route('guest-home') }}">
                                    <img src="{{ asset('img/DeliveBoo_logo.png') }}" alt="DeliveBoo logo">
                                </a>
                            </div>
    
                            <div class="col-xs-3 col-md-4 text-center debug">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Milano</span>
                            </div>
    
                            @if (Route::has('login'))
                                <div class="col-xs-5 col-md-4 text-right debug">
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
                <div class="title m-b-md">
                    DeliveBoo
                </div>
                <h2 class='category'>@{{ selected_category }}</h2>
                <div class="ristoranti">
                    <span v-if='flag != false && selected_category != ""' v-for='(restaurant, index) in restaurants'>
                        <form action="{{ route('order.create')}}" method="get">
                            <div class=" form-group my-hidden">
                                <input name="user_id" type="text" :value="(restaurant.user_id != '') ? restaurant.user_id : 'default'">
                                <input name="user_slug" type="text" :value="(restaurant.slug != '') ? restaurant.slug : 'default'">
                            </div>
                            <button type="submit"> @{{ restaurant.slug.charAt(0).toUpperCase() + restaurant.slug.slice(1).replace('-', ' ') }}</button>
    
                        </form>
                    </span>
                    <span v-for='(element, index) in collection' v-if='flag == false && selected_category != ""'>
                        <form action="{{ route('order.create')}}" method="get">
                            <div class=" form-group my-hidden">
                                <input name="user_id" type="text" :value="(element.user_id != '') ? element.user_id : 'default'">
                                <input name="user_slug" type="text" :value="(element.slug != '') ? element.slug : 'default'">
                            </div>
                            <button  type="submit">@{{element.slug.replace('-', ' ') }}</button>
    
                        </form>
                    </span>
                </div>
                <div v-if='selected_category != ""' class="searchbar">
                    <form action="" method=''>
                        <input v-if='flag != false' v-model='searchFilter' placeholder='Find your restaurant' type="text">
                        <input v-if='flag != false' v-on:click='searchResults' type="button"  value='Search'>
                        <input v-on:click='selected_category = ""' type="button" value='Back to categories'>
                        <input v-if='flag == false' v-on:click='resetRestaurants' type="button" value='Back to all restaurants'>
                    </form>
                </div>
                <div v-if='selected_category == ""' class="categories">
                    <button type='sumbit'  v-on:click='getRestaurants(category)' v-for='(category,index) in categories'>@{{category.name}}</button type='sumbit'>
                </div>
            </div>
        </div>
    </body>
</html>
