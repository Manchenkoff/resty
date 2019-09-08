<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

use yii\helpers\ArrayHelper;

$config = require __DIR__ . '/../console.php';

$codeception = [
    'id' => 'app-tests',

    'components' => [
        // add suffix '_test' to the database name
        'db' => [
            'dsn' => env('DB_CONNECTION')
                . ':host=' . env('DB_HOST')
                . ';port=' . env('DB_PORT')
                . ';dbname=' . env('DB_NAME') . '_test',
        ],
    ],
];

return ArrayHelper::merge($config, $codeception);