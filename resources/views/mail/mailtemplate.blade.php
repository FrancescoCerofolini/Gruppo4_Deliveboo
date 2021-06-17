
<h1>Grazie per averci scelto {{$test->customer_name}} !</h1>
<h2>Di seguito il riepilogo del tuo ordine</h2>
<ul>
    <li>{{ ($test->status == "SUBMITTED_FOR_SETTLEMENT") ? 'Il pagamento è stato accettato e l\' ordine è stato confermato' : ''}}</li>  
    <li>{{  'Il tuo ordine è il numero : ' . $test->code }}</li>  
    <li>{{  'Il totale del pagamento è : ' . $test->amount . '€' }}</li>  
    <li>{{ 'L\' ordine sarà spedito all\' indirizzo : '. $test->customer_address }}</li>
</ul>
