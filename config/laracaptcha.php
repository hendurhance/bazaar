<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Default Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default captcha driver that will be used to
    | send captcha challenges to users. This driver manages the
    | retrieval and validation of captcha challenges.
    |
    | Supported: "recaptcha", "hcaptcha"
    |
    */

    'default' => env('CAPTCHA_DRIVER', 'recaptcha'),

    /*
    |--------------------------------------------------------------------------
    | Captcha Drivers
    |--------------------------------------------------------------------------
    |
    | Here you may configure the captcha drivers for your application.
    | Supported: "recaptcha", "hcaptcha"
    |
    */

    'drivers' => [
        'recaptcha' => [
            'site_key' => env('RECAPTCHA_SITE_KEY'),
            'secret_key' => env('RECAPTCHA_SECRET_KEY'),
            'site_url' => env('RECAPTCHA_SITE_URL'), // Used for reCAPTCHA v3 'action
            'script_url' => 'https://www.google.com/recaptcha/api.js',
            'verify_url' => 'https://www.google.com/recaptcha/api/siteverify',
            'version' => 'v3', // Supported: v2, v3
            'options' => [
                'timeout' => 30,
            ],
        ],
        'hcaptcha' => [
            'site_key' => env('HCAPTCHA_SITE_KEY'),
            'secret_key' => env('HCAPTCHA_SECRET_KEY'),
            'script_url' => 'https://js.hcaptcha.com/1/api.js',
            'verify_url' => 'https://hcaptcha.com/siteverify',
            'options' => [
                'timeout' => 30,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Captcha Default Language
    |--------------------------------------------------------------------------
    |
    | Here you may configure the default language used by the captcha
    | challenges. Supported: "en", "es", "fr", "pt", "ru", "tr" etc.
    | @link https://developers.google.com/recaptcha/docs/language Google reCAPTCHA
    | @link https://docs.hcaptcha.com/languages hCaptcha
    |
    */

    'language' => 'en',

    /*
    |--------------------------------------------------------------------------
    | reCaptcha v3 Skip IPs
    |--------------------------------------------------------------------------
    |
    | Here you may configure whether to skip IP address validation when
    | validating reCaptcha v3 challenges. This is useful when testing
    | locally.
    |
    */

    'skip_ips' => [],

    /*
    |--------------------------------------------------------------------------
    | reCaptcha Input ID
    |--------------------------------------------------------------------------
    |
    | Here you may configure the ID of the captcha input field. This is
    | useful when using multiple captcha challenges on the same page.
    |
    */

    'recaptcha_input_identifier' => 'g-recaptcha-response-laracaptcha',

    /*
    |--------------------------------------------------------------------------
    | reCaptcha Input Name
    |--------------------------------------------------------------------------
    |
    | Here you may configure the name of the captcha input field. This is
    | useful when using multiple captcha challenges on the same page.
    |
    */

    'recaptcha_input_name' => 'g-recaptcha-response',

    /*
    |--------------------------------------------------------------------------
    | hCaptcha Input Name
    |--------------------------------------------------------------------------
    |
    | Here you may configure the name of the captcha input field. This is
    | useful when using multiple captcha challenges on the same page.
    |
    */

    'hcaptcha_input_name' => 'h-recaptcha-response',

    /*
    |--------------------------------------------------------------------------
    | reCaptcha Score Enabled
    |--------------------------------------------------------------------------
    |
    | Here you may configure whether to enable score validation when
    | validating reCaptcha v3 challenges. This is useful when testing
    | locally.
    |
    */

    'recaptcha_score_enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | reCaptcha v3 Settings
    |--------------------------------------------------------------------------
    |
    | Here you may configure the settings used when validating reCaptcha v3
    | challenges. This is useful to check 
    | action: Google reCAPTCHA v3 action
    | minimum_score: Google reCAPTCHA v3 minimum score
    | score_comparison: Google reCAPTCHA v3 score comparison (true/false)
    |
    */

    'recaptcha_v3_settings' => [
        'action' => 'homepage',
        'minimum_score' => 0.5,
        'score_comparison' => true,
    ],


    /*
    |--------------------------------------------------------------------------
    | Captcha Error Message
    |--------------------------------------------------------------------------
    |
    | Here you may configure the error message used when captcha validation
    | fails. This message is used when the "captcha" validation rule
    | fails.
    |
    */

    'error_message' => 'The captcha challenge was not completed successfully, please try again.',

    /*
    |--------------------------------------------------------------------------
    | Captcha Validation Rule
    |--------------------------------------------------------------------------
    |
    | Here you may configure the name of the captcha validation rule. This
    | rule is used when validating captcha challenges.
    |
    */

    'validation_rule' => [
        'recaptcha' => 'recaptcha',
        'hcaptcha' => 'hcaptcha',
    ],
];
