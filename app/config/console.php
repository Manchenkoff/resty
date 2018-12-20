<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),

    /**
     * Bootstrap configuration
     */
    'bootstrap' => [
        'log',
    ],

    'controllerNamespace' => 'app\controllers\console',

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],

    /**
     * Framework components configuration
     */
    'components' => [
        'db' => include('db.php'),

        'log' => [
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],

    'params' => [],
];