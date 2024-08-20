<?php

use Illuminate\Support\Str;

return [

    // Session driver - for development use 'file', for production consider 'redis' or 'database'
    'driver' => env('SESSION_DRIVER', 'file'),

    // Session lifetime in minutes
    'lifetime' => env('SESSION_LIFETIME', 120),

    // Expire session on browser close
    'expire_on_close' => false,

    // Encrypt session data
    'encrypt' => false,

    // Session file storage location
    'files' => storage_path('framework/sessions'),

    // Database connection for 'database' driver
    'connection' => env('SESSION_CONNECTION', null),

    // Database table for sessions
    'table' => 'sessions',

    // Cache store for 'redis' driver
    'store' => env('SESSION_STORE', null),

    // Lottery for garbage collection
    'lottery' => [2, 100],

    // Session cookie name
    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),

    // Session cookie path
    'path' => '/',

    // Session cookie domain
    'domain' => env('SESSION_DOMAIN', null),

    // Secure session cookie (HTTPS only)
    'secure' => env('SESSION_SECURE_COOKIE', false),

    // HTTP only session cookie
    'http_only' => true,

    // Same-site cookie policy
    'same_site' => 'lax',

];

