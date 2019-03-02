<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

return [
    'class' => \yii\db\Connection::class,
    'charset' => 'utf8',
    'tablePrefix' => 'resty_',

    // SQLite
    //'dsn' => 'sqlite:@app/database/main.sqlite',
    // MySQL
    'dsn' => 'mysql:host=db;dbname=resty',
    'username' => 'root',
    'password' => 'root',
];
