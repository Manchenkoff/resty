<?php
/**
 * Created by Artyom Manchenkov
 * Copyright © 2015-2018 [DeepSide Interactive]
 */

return [
    /**
     * SiteController
     */
    [
        'class' => yii\rest\UrlRule::class,
        'controller' => 'site',
        'pluralize' => false,
    ],

    /**
     * Post Controller
     */
    [
        'class' => yii\rest\UrlRule::class,
        'controller' => 'post',
        'extraPatterns' => [
            'GET desc' => 'desc',
        ],
    ],
];