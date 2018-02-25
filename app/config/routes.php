<?php
/**
 * Created by Artyom Manchenkov
 * Copyright © 2015-2018 [DeepSide Interactive]
 */

use yii\rest\UrlRule;

return [
    /**
     * SiteController
     */
    [
        'class' => UrlRule::class,
        'controller' => 'site',
        'pluralize' => false,
    ],

    /**
     * Post Controller
     */
    [
        'class' => UrlRule::class,
        'controller' => 'post',
        'pluralize' => true,
        'extraPatterns' => [
            //'METHOD action' => 'actionFunction',
            'GET limit' => 'limit'
        ],
    ],
    
    /**
     * User Controller
     */
    [
        'class' => UrlRule::class,
        'controller' => 'user',
        'pluralize' => true,
        'extraPatterns' => [
            // actions
        ],
    ],
];