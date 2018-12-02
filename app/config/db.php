<?php
/**
 * Created by Artyom Manchenkov
 * Copyright © 2015-2018 [DeepSide Interactive]
 */

return [
    'class' => \yii\db\Connection::class,
    'charset' => 'utf8',
    'tablePrefix' => 'resty_',

    // SQLite
    'dsn' => 'sqlite:@app/database/main.sqlite',
    // MySQL
    //'dsn' => 'mysql:host=127.0.0.1;dbname=resty',
];
