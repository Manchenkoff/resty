<?php
/**
 * Created by Artyom Manchenkov
 * Copyright © 2015-2018 [DeepSide Interactive]
 */

$root_dir = realpath(__DIR__ . '/../../');

$config = [
    'id' => 'resty',

    'defaultRoute' => 'site/index',

    'basePath' => $root_dir,

    'controllerNamespace' => 'resty\controllers',

    'aliases' => [
        '@resty' => $root_dir . '/app',
    ],

    'bootstrap' => [
        [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON
            ]
        ],
    ],

    'components' => [
        'db' => include('db.php'),

        'request' => [
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => yii\web\JsonParser::class,
            ],
        ],

        'response' => [
            'formatters' => [
                \yii\web\Response::FORMAT_JSON => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],

        'user' => [
            'identityClass' => resty\models\User::class,
            'enableSession' => false,
            'enableAutoLogin' => false,
        ],

        'authManager' => [
            'class' => yii\rbac\DbManager::class,
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,

            'rules' => include('routes.php'),
        ],
    ],

    'params' => [
        'token_auth' => [
            'class' => yii\filters\auth\QueryParamAuth::class,
            'tokenParam' => 'token',
        ],
        'basic_auth' => [
            'class' => \yii\filters\auth\HttpBasicAuth::class,
            'auth' => 'resty\models\User::basicAuth',
        ],
    ],
];

// adapt config to CLI (console mode)
if (php_sapi_name() == "cli") {
    unset($config['bootstrap']);
    unset($config['components']['request']);
    unset($config['components']['response']);
    $config['components']['user']['class'] = resty\models\User::class;
}

return $config;