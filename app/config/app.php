<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

use yii\filters\ContentNegotiator;
use yii\web\Response;

$root_dir = dirname(dirname(__DIR__));

$config = [
    'id' => 'resty',

    'defaultRoute' => 'site/index',

    'basePath' => $root_dir,

    /**
     * Main controllers namespace
     */
    'controllerNamespace' => 'app\controllers',

    /**
     * Project path aliases
     */
    'aliases' => [
        '@app' => $root_dir . '/app',
    ],

    /**
     * Components for pre-loading with application
     */
    'bootstrap' => [
        [
            'class' => ContentNegotiator::class,
            'formats' => ['application/json' => Response::FORMAT_JSON],
        ],
    ],

    /**
     * Application components
     */
    'components' => include('components.php'),

    /**
     * Dependency injection definitions
     */
    'container' => include('container.php'),

    /**
     * Application custom parameters
     */
    'params' => [],
];

return $config;
