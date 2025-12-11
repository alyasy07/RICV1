<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        
        // Add API guard if needed for future mobile apps
        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],

        // Independent new auth guard (separate from existing Fortify/Jetstream)
        'newweb' => [
            'driver' => 'session',
            'provider' => 'new_users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
            'table' => 'user',
        ],

        // Provider for the independent new auth system
        'new_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\NewUser::class,
            'table' => 'new_users',
        ],

        // Uncomment if you need secondary user provider
        // 'staff' => [
        //     'driver' => 'eloquent',
        //     'model' => App\Models\Staff::class,
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'new_users' => [
            'provider' => 'new_users',
            'table' => 'new_password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        
        // Add if you have different user types
        // 'staff' => [
        //     'provider' => 'staff',
        //     'table' => 'password_reset_tokens',
        //     'expire' => 60,
        //     'throttle' => 60,
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */
    'password_timeout' => 10800, // 3 hours

    /*
    |--------------------------------------------------------------------------
    | Custom Configuration for FTMS Jupem
    |--------------------------------------------------------------------------
    */
    'jupem' => [
        'min_password_length' => 8,
        'password_history' => 3, // Remember last 3 passwords
        'login_attempts' => 5, // Lock after 5 attempts
    ],

    'lifetime' => env('SESSION_LIFETIME', 120),
    'expire_on_close' => true,
    'secure' => env('SESSION_SECURE_COOKIE', true),
    'http_only' => true,
    'same_site' => 'lax',
];