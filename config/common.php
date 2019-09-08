<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

return [
    /**
     * Database connection
     */
    'db' => require __DIR__ . '/db.php',

    /**
     * Application cache component
     */
    'cache' => [
        'class' => yii\caching\FileCache::class,
    ],

    /**
     * RBAC component settings
     */
    'authManager' => [
        'class' => yii\rbac\DbManager::class,
    ],

    /**
     * Application logger component
     */
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => yii\log\FileTarget::class,
                'levels' => ['error', 'warning'],
            ],
        ],
    ],

    /**
     * Application router settings
     */
    'urlManager' => [
        'class' => manchenkov\yii\http\routing\RouteManager::class,
        'routesDirectory' => dirname(__DIR__) . '/app/routes',
    ],

    /**
     * Translator component
     */
    'i18n' => [
        'translations' => [
            '*' => [
                'class' => yii\i18n\PhpMessageSource::class,
                'basePath' => '@app/messages',
            ],
        ],
    ],
];
