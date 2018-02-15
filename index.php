<?php

// ONLY DEVELOPMENT
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
// ONLY DEVELOPMENT

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');

$config = require __DIR__ . '/config.php';

(new yii\web\Application($config))->run();
