<?php

// ONLY DEVELOPMENT
define('YII_DEBUG', true);
define('YII_ENV', 'dev');
// ONLY DEVELOPMENT

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');

$config = require __DIR__ . '/app/config/app.php';

try {
    $app = new yii\web\Application($config);
    $app->run();
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
    die();
}
