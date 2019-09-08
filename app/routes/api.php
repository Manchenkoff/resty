<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

use manchenkov\yii\http\routing\Route;

return [

    Route::get('/', 'site/index'),

    Route::resource('user'),
    Route::resource('post'),

];

