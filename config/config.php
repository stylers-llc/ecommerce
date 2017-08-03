<?php

return [
    'product_type' => 500,
    'product_types' => [
        'equipment' => 501,
    ],
    'product_description_type' => 502,
    'product_description_types' => [
        'short_description' => 503,
        'long_description' => 504
    ],
    'basket_status' => 505,
    'basket_statuses' => [
        'created' => 506,
        'paid' => 507,
        'reserved' => 508,
        'canceled' => 509,
    ],
    'transaction_pay_status' => 510,
    'transaction_pay_statuses' => [
        'created' => 511,
        'paid' => 512,
        'canceled' => 513
    ],
    'default_currency' => 'CAD',
    'email_from' => 'example@dot.com',
    'paypal' => [
        'client_id' => 'client',
        'secret' => 'secret',
        'settings' => [
            /**
             * Available option 'sandbox' or 'live'
             */
            'mode' => 'sandbox',

            /**
             * Specify the max request time in seconds
             */
            'http.ConnectionTimeOut' => 1000,

            /**
             * Whether want to log to a file
             */
            'log.LogEnabled' => true,

            /**
             * Specify the file that want to write on
             */
            'log.FileName' => storage_path() . '/logs/paypal.log',

            /**
             * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
             *
             * Logging is most verbose in the 'FINE' level and decreases as you
             * proceed towards ERROR
             */
            'log.LogLevel' => 'FINE'
        ],
        'payment_intent' => [
            "sale" => "sale",
            "authorize" => "authorize",
            "order" => "order"
        ],
        'payment_method' => [
            "credit_card" => "credit_card",
            "bank" => "bank",
            "paypal" => "paypal",
            "pay_upon_invoice" => "pay_upon_invoice",
            "carrier" => "carrier",
            "alternate_payment" => "alternate_payment"
        ],
        'payment_state' => [
            'created' => 'created',
            'approved' => 'approved',
            'failed' => 'failed'
        ]
    ]
];