<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Payment Gateway Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for payment gateway services such
    | as Stripe, Paystack, Flutterwave, etc. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional place to find your various credentials.
    |
    */

    'flutterwave' => [
        'base_url' => 'https://api.flutterwave.com/v3/',
        'secret_key' => env('FLUTTERWAVE_SECRET_KEY'),
        'public_key' => env('FLUTTERWAVE_PUBLIC_KEY'),
        'encryption_key' => env('FLUTTERWAVE_ENCRYPTION_KEY'),
        'redirect_url' => env('FLUTTERWAVE_REDIRECT_URL'),
    ],

    'paystack' => [
        'base_url' => 'https://api.paystack.co/',
        'secret_key' => env('PAYSTACK_SECRET_KEY'),
        'public_key' => env('PAYSTACK_PUBLIC_KEY'),
        'redirect_url' => env('PAYSTACK_REDIRECT_URL'),
    ],

    'currencies' => [
        'default' => 'NGN',

        'NGN' => [
            'name' => 'Nigerian Naira',
            'symbol' => '₦',
            'code' => 'NGN',
        ],
        'USD' => [
            'name' => 'United States Dollar',
            'symbol' => '$',
            'code' => 'USD',
        ],
        'GBP' => [
            'name' => 'British Pound Sterling',
            'symbol' => '£',
            'code' => 'GBP',
        ],
        'EUR' => [
            'name' => 'Euro',
            'symbol' => '€',
            'code' => 'EUR',
        ],
        'CAD' => [
            'name' => 'Canadian Dollar',
            'symbol' => '$',
            'code' => 'CAD',
        ],
        'GHS' => [
            'name' => 'Ghanaian Cedi',
            'symbol' => '₵',
            'code' => 'GHS',
        ],
        'KES' => [
            'name' => 'Kenyan Shilling',
            'symbol' => 'KSh',
            'code' => 'KES',
        ],
    ],

    'payout' => [
        'fee' => 5.0, // 5%
        'processing_time' => 3, // 3 days
    ]
];
