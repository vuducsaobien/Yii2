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
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        // 'log'
        'queue', // The component registers its own console commands
    ],
    'controllerNamespace' => 'app\commands',
    'timeZone' => 'Asia/Ho_Chi_Minh',
    // 'timeZone' => 'UTC',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        // 'queue' => [ // 1. Driver Synchronous
        //     'class' => \yii\queue\sync\Queue::class,
        //     'handle' => false, // if tasks should be executed immediately
        // ],
        'queue' => [ // 2. Driver File
            'class' => \yii\queue\file\Queue::class,
            'path' => '@runtime/queue',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => false, // Always send real emails
            'transport' => [
                'dsn' => env('MAILER_TRANSPORT') === 'smtp' 
                    ? 'smtp://' . env('MAILER_USERNAME') . ':' . env('MAILER_PASSWORD') . '@' . env('MAILER_HOST') . ':' . env_int('MAILER_PORT')
                    : 'null://null',
            ],
        ],
        'mailService' => [
            'class' => 'app\services\MailService',
        ],
        'queueService' => [
            'class' => 'app\services\QueueService',
        ],
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
    // configuration adjustments for 'dev' environment
    // requires version `2.1.21` of yii2-debug module
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'panels' => [
            'queue' => \yii\queue\debug\Panel::class,
        ],
    ];
}

return $config;
