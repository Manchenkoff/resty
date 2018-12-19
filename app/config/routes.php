<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

use yii\rest\UrlRule;

return [
    /**
     * SiteController
     */
    'test' => 'site/index',

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
            'GET limit' => 'limit',
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