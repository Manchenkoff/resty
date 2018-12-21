<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

return [
    'id' => 'resty-cli',
    'basePath' => dirname(__DIR__),

    /**
     * Components for pre-loading with application
     */
    'bootstrap' => [
        'log',
    ],

    'controllerNamespace' => 'app\controllers\console',

    'aliases' => [],

    /**
     * Application components
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