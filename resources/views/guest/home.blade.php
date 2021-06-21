<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .my-hidden {
                display: none;
            }
        </style>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div id='app' class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/admin') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    DeliveBoo
                </div>
                <h2 class='category'>@{{ selected_category }}</h2>
                <div class="ristoranti">
                    <span v-if='flag != false' v-for='(restaurant, index) in restaurants'>
                        <form action="{{ route('order.create')}}" method="get">
                            <div class=" form-group my-hidden">
                                <input name="user_id" type="text" :value="(restaurant.user_id != '') ? restaurant.user_id : 'default'">
                                <input name="user_slug" type="text" :value="(restaurant.slug != '') ? restaurant.slug : 'default'">
                            </div>
                            <button type="submit">ordina da @{{restaurant.slug}}</button>
    
                        </form>
                    </span>
                    <span v-for='(element, index) in collection' v-if='flag == false'>
                        <form action="{{ route('order.create')}}" method="get">
                            <div class=" form-group my-hidden">
                                <input name="user_id" type="text" :value="(element.user_id != '') ? element.user_id : 'default'">
                                <input name="user_slug" type="text" :value="(element.slug != '') ? element.slug : 'default'">
                            </div>
                            <button type="submit">ordina da @{{element.slug}}</button>
    
                        </form>
                    </span>
                </div>
                <div v-if='selected_category != ""' class="searchbar">
                    <form action="" method=''>
                        <input v-model='searchFilter'  type="text">
                        <input v-on:click='searchResults' type="button" value='Search'>
                        <input v-if='flag == false' v-on:click='resetRestaurants' type="button" value='reset'>
                    </form>
                </div>
                <div v-if='selected_category == ""' class="categories">
                    <button type='sumbit'  v-on:click='getRestaurants(category)' v-for='(category,index) in categories'>@{{category.name}}</button type='sumbit'>
                </div>
            </div>
        </div>
    </body>
</html>
