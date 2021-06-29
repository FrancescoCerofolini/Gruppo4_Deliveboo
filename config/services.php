<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'braintree' => [
        'environment' => env('BT_ENVIRONMENT', 'sandbox'),
        'merchantId' => env('BT_MERCHANT_ID', 'sq492dgh2fxktw4h'),
        'publicKey' => env('BT_PUBLIC_KEY', 'yp8rp7dcqjncwdkx'),
        'privateKey' => env('BT_PRIVATE_KEY', '1a96cf7a799051ec4b9ef6b051e010cc'),
    ],

];
