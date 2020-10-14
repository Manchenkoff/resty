<?php

return [
    'class' => yii\db\Connection::class,

    // connection settings
    'dsn' => env('DB_CONNECTION')
        . ':host=' . env('DB_HOST')
        . ';port=' . env('DB_PORT')
        . ';dbname=' . env('DB_NAME'),
    'username' => env('DB_USER'),
    'password' => env('DB_PASSWORD'),
    'charset' => 'utf8',

    // database schema caching (optimization)
    'enableSchemaCache' => env('DB_USE_CACHE'),
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache',
];
