<footer>
    <div class="container justify-content-flex-bottom">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="block">
                    <h3>Contattaci</h3>
                    <ul>
                        <li>telefono: <strong>+39 123 456789</strong></li>
                        <li>email: <strong>deliveboo@mail.it</strong></li>
                        <img src="{{ asset('img/AppStore.svg') }}" alt="apple-store-logo" class="apple">
                        <img src="{{ asset('img/PlayStore.png') }}" alt="play-store-logo" class="play">

                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="block">
                    <h3>Lavora Con Noi</h3>
                    <ul>
                        <div class="disabled">
                            <li>
                            <a class="pointer-events" href=""><span>Diventa un Rider</span></a>
                            </li>
                            <li>
                            <a class="pointer-events" href=""><span>Diventa un nostro Partner</span></a>
                            </li>
                            <li>
                            <a class="pointer-events" href=""><span>Diventa uno Sviluppatore</span></a>
                            </li>
                            <li>
                            <a class="pointer-events" href=""><span>SEZIONE IN COSTRUZIONE</span></a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="block">
                    <h3>Sei un Ristorante?</h3>
                    <ul>
                        <li><a href="{{asset('/login')}}">Login</a></li>
                        <li><a href="{{asset('/register')}}">Registrati</a></li>
                        <li><a href="{{asset('/admin/dish')}}">Personalizza il tuo menù</a></li>
                        <li><a href="{{asset('/admin/order')}}">Visualizza lo Storico Ordini</a></li>
                        <li><a href="{{asset('/admin/statistics')}}">Visualizza le tue Statistiche</a></li>


                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="block">
                    <h3>Note legali</h3>
                    <ul>
                        <li><a href="#">Termini & Condizioni</a></li>
                        <li><a href="#">Informativa sulla privacy</a></li>
                        <li><a href="#">Cookies</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 foot_bottom">
                    <img src="{{ asset('img/DeliveBoo_logo.png') }}" alt="DeliveBoo logo">
            </div>

            <div class="col-md-6 col-sm-12 foot_bottom">
                <div class="social">
                    <ul>
                        <li><i class="fab fa-facebook-f"></i></li>
                        <li><i class="fab fa-instagram"></i></li>
                        <li><i class="fab fa-youtube"></i></li>
                        <li><i class="fab fa-twitter"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        

    </div>
</footer>