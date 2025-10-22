<?php

return [
    // Application parameters
    'senderEmail' => env('MAILER_FROM_ADDRESS'),
    'senderName' => env('MAILER_FROM_NAME'),
    'adminEmail' => env('APP_ADMIN_EMAIL'),
    'appName' => env('APP_NAME'),
    'appTitle' => env('APP_TITLE'),
    'appUrl' => env('APP_URL'),
    
    // Database parameters
    'dbHost' => env('DB_HOST'),
    'dbName' => env('DB_NAME'),
    'dbUsername' => env('DB_USERNAME'),
    'dbPassword' => env('DB_PASSWORD'),
    'dbPort' => env_int('DB_PORT'),
    
    // Email parameters
    'mailerTransport' => env('MAILER_TRANSPORT'),
    'mailerHost' => env('MAILER_HOST'),
    'mailerPort' => env_int('MAILER_PORT'),
    'mailerUsername' => env('MAILER_USERNAME'),
    'mailerPassword' => env('MAILER_PASSWORD'),
    'mailerEncryption' => env('MAILER_ENCRYPTION'),
    
    // Docker environment
    'dockerEnv' => is_docker(),
    'isProduction' => is_production(),
    'isDevelopment' => is_development(),
];