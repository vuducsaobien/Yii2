<?php

// Load environment variables using env.php
require __DIR__ . '/../config/env.php';

// Load helpers
require __DIR__ . '/../config/helpers.php';

// Define constants from environment
defined('YII_DEBUG') or define('YII_DEBUG', env_bool('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', env('YII_ENV', 'dev'));

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
