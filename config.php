<?php

return [
    'id' => 'resty',

    'defaultRoute' => 'site/index',

    'basePath' => __DIR__,

    'controllerNamespace' => 'resty\controllers',

    'aliases' => [
        '@resty' => __DIR__ . '/app',
    ],

    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlite:@resty/database/main.sqlite',
            'charset' => 'utf8',
            'tablePrefix' => 'resty_',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'site',
                    'pluralize' => false,
                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'post',
                ],
            ],
        ],
    ],
];