<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Masslytics API Token
    |--------------------------------------------------------------------------
    |
    | The API token that is sent as a bearer token with every request.
    |
     */
    'token' => env('MASSLYTICS_TOKEN', ''),

    /*
    |--------------------------------------------------------------------------
    | Masslytics URL
    |--------------------------------------------------------------------------
    |
    | The base URL of the Masslytics application the requests are sent to.
    |
     */
    'url' => env('MASSLYTICS_URL', 'https://app.masslytics.io'),
];
