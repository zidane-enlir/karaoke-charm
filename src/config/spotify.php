<?php

return [

    'auth' => [
        'client_id' => env('SPOTIFY_CLIENT_ID'),
        'client_secret' => env('SPOTIFY_CLIENT_SECRET'),
    ],

    'default_config' => [
        'country' => env('SPOTIFY_DEFAULT_COUNTRY', ''),
        'locale' => env('SPOTIFY_DEFAULT_LOCALE', ''),
        'market' => env('SPOTIFY_DEFAULT_MARKET', ''),
    ],

];
