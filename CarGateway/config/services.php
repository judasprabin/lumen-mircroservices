<?php

return [
    'owners' => [
        'base_uri' => env('OWNERS_SERVICE_BASE_URL'),
        'secret' => env('OWNERS_SERVICE_SECRET')
    ],

    'cars' => [
        'base_uri' => env('CARS_SERVICE_BASE_URL'),
        'secret' => env('CARS_SERVICE_SECRET')
    ]
];