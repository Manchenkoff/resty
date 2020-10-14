<?php

declare(strict_types=1);

use manchenkov\yii\http\routing\Route;

return [

    Route::get('/', 'site/index'),

    Route::resource('user'),
    Route::resource('post'),

];
