<?php

return [

    'default' => env('WOOCOMMERCE_CONNECTION', 'default'),
    'class' => \C14r\Woocommerce\V3\API::class,

    'connections' => [

        // default connection
        'default' => [
            'url' => env('WOOCOMMERCE_URL'),
            'key' => env('WOOCOMMERCE_KEY'),
            'secret' => env('WOOCOMMERCE_SECRET'),
            'options' => [
                'version' => env('WOOCOMMERCE_VERSION', 'wc/v3')
            ],
        ],

    ],

    'cache' => [
        'ttl' => 300,
        'prefix' => 'c14r_woo_',
    ]
    
];