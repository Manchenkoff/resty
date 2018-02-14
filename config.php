<?php

return [
    'id' => 'resty',

    'basePath' => __DIR__,

    'controllerNamespace' => 'resty\controllers',

    'aliases' => [
        '@resty' => __DIR__,
    ],

    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlite:@resty/database/main.sqlite',
        ],
    ],
];