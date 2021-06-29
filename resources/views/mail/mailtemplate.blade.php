<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <title>Riepilogo pagamento</title>
</head>
<body>
    <header>
        {{-- navbar --}}
        <div class="my-navbar">
            <div class="header-left">
                <a href="{{ route('guest-home') }}">
                    <img src="{{ asset('img/DeliveBoo_logo.png') }}" alt="DeliveBoo logo" id="logo_big">
                    <img src="{{ asset('img/DeliveBoo_logo_small.png') }}" alt="DeliveBoo logo small" id="logo_small">
                </a>
            </div>
    </header> 
    <main>
        <h1>Grazie per averci scelto {{$test['customer_name']}} !</h1>
        <h2>Di seguito l'esito del tuo ordine :</h2>
        <ul>
            <li>{{ 'Il pagamento è stato accettato e l\' ordine è stato confermato !' }}</li>  
            <li>{{  'Il tuo ordine è il numero : ' . $test[0] }}</li>  
            
            <li>{{ 'L\' ordine sarà spedito all\' indirizzo : '. $test['customer_address'] }}</li>

            <h3>Riepilogo del tuo carrello :</h3>
            @foreach ($test['dish_id'] as $index => $item)
                    @if ($test['quantity'][$index] > 0)
                        <li>- {{ucfirst($test[1][$index][0]->name)}} x {{$test['quantity'][$index]}} : {{$test[1][$index][0]->price * $test['quantity'][$index]}} €</li>
                    @endif                        
            @endforeach
            <li>{{  '- Il totale del pagamento è : ' . $test['amount'] . '€' }}</li>  
        </ul>
    </main>
    <footer>
        <hr>
        <h4>Team 4 Deliveboo</h4>
        Per qualsiasi informazione rimaniamo a tua completa disposizione presso :
        <ul>
            <li>telefono: +39 123 456789</li>
            <li>email: deliveboo@gmail.com</li>
            <li>instagram: #deliveboo</li>
            <li>facebook: Deliveboo Official</li>           
        </ul>
    </footer>
    
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Nunito', sans-serif;
        }
        body {
            padding: 5px;
        }
        footer {
            margin-top: 20px;
        }
        footer h4 {
            color: red;
        }
    </style>
</body>
</html>



    


