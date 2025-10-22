<?php

// Load helpers
require_once __DIR__ . '/helpers.php';

// Define constants from environment
defined('YII_DEBUG') or define('YII_DEBUG', env_bool('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', env('YII_ENV', 'dev'));
defined('YII_ENV_DEV') or define('YII_ENV_DEV', YII_ENV === 'dev');
defined('YII_ENV_PROD') or define('YII_ENV_PROD', YII_ENV === 'prod');

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => env('APP_COOKIE_VALIDATION_KEY'),
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => env('MAILER_TRANSPORT') === 'file',
            'transport' => [
                'class' => env('MAILER_TRANSPORT') === 'smtp' ? \Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport::class : \Symfony\Component\Mailer\Transport\NullTransport::class,
                'host' => env('MAILER_HOST'),
                'port' => env_int('MAILER_PORT'),
                'username' => env('MAILER_USERNAME'),
                'password' => env('MAILER_PASSWORD'),
                'encryption' => env('MAILER_ENCRYPTION'),
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        // Register CustomerService in DI container
        'customerService' => [
            'class' => 'app\services\CustomerService',
        ],
        // Register OrderService in DI container
        'orderService' => [
            'class' => 'app\services\OrderService',
        ],
        'itemService' => [
            'class' => 'app\services\ItemService',
        ],
        //
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        //
        'response' => [
            'class' => 'yii\web\Response',
            'format' => \yii\web\Response::FORMAT_JSON,
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'], // Allow all IPs for development
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'], // Allow all IPs for development
    ];
}

return $config;
