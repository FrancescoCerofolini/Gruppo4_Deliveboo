<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Mail</title>
    <link rel="stylesheet" href="{{asset('css/app.scss')}}">
</head>
<body>
    <main>
        <h1>Grazie per averci scelto {{$test->customer_name}} !</h1>
        <h2>Di seguito l'esito del tuo ordine :</h2>
        <ul>
            <li>{{ ($test->status == "SUBMITTED_FOR_SETTLEMENT") ? 'Il pagamento è stato accettato e l\' ordine è stato confermato' : ''}}</li>  
            <li>{{  'Il tuo ordine è il numero : ' . $test->code }}</li>  
            <li>{{  'Il totale del pagamento è : ' . $test->amount . '€' }}</li>  
            <li>{{ 'L\' ordine sarà spedito all\' indirizzo : '. $test->customer_address }}</li>
        </ul>
    </main>
    <footer>
        <ul style="list-style: none">
            Contattacci :
            <li>Telefono: +39 123 456789</li>
            <li>Email: deliveboo@gmail.com</li>
            <li>Instagram: #deliveboo</li>
            <li>Facebook: DelivebooFB</li>
        </ul>
    </footer>
    
    
</body>
</html>

