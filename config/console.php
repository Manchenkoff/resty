<?php

/**
 * Main CLI application configuration file
 */
return [
    'id' => 'app-console',

    'language' => env('APP_LANGUAGE'),
    'charset' => env('APP_CHARSET'),
    'name' => env('APP_NAME'),

    'controllerNamespace' => 'app\commands',

    'basePath' => '@app',
    'vendorPath' => '@vendor',
    'runtimePath' => '@runtime',

    'controllerMap' => [
        // custom configuration
        'migrate' => [
            'class' => yii\console\controllers\MigrateController::class,
            'migrationPath' => [
                // Application migrations
                '@app/database/migrations',

                //'@yii/caching/migrations',
                //'@yii/log/migrations',
                '@yii/rbac/migrations',
            ],
        ],
        'serve' => [
            'class' => yii\console\controllers\ServeController::class,
            'docroot' => dirname(__DIR__),
        ],
    ],

    /**
     * Components and modules for pre-loading
     */
    'bootstrap' => [
        // components and modules will be here
    ],

    /**
     * Application modules
     */
    'modules' => [
        // modules configuration will be here
    ],

    /**
     * Dependency Injection container
     */
    'container' => require __DIR__ . '/container.php',

    /**
     * Application parameters
     */
    'params' => require __DIR__ . '/params.php',

    /**
     * Application components
     */
    'components' => yii\helpers\ArrayHelper::merge(
        require __DIR__ . '/common.php',

        // current application components only
        [
            // ...
        ]
    ),
];
