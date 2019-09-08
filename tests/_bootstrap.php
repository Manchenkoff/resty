<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

defined('YII_APP_BASE_PATH') or define('YII_APP_BASE_PATH', dirname(__DIR__));
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require_once YII_APP_BASE_PATH . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Load environments configuration
$env = Dotenv::create(YII_APP_BASE_PATH);

try {
    $env->load();
} catch (Exception $error) {
    alert("App environment initialization failed");
    die();
}

// Load Yii application requirements
require YII_APP_BASE_PATH . '/vendor/yiisoft/yii2/Yii.php';
require YII_APP_BASE_PATH . '/config/aliases.php';
