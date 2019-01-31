<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

return [
    'db' => include('db.php'),

    'request' => [
        'enableCookieValidation' => false,
        'parsers' => [
            'application/json' => \yii\web\JsonParser::class,
        ],
    ],

    'response' => [
        'class' => \yii\web\Response::class,
        // custom response format
        'on beforeSend' => function ($event) {
            /** @var \yii\web\Response $response */
            $response = $event->sender;

            if (!$response->isEmpty) {
                $response->data = [
                    'success' => $response->isSuccessful,
                    'data' => $response->data,
                ];

                $response->statusCode = 200;
            }
        },
        'format' => \yii\web\Response::FORMAT_JSON,
        'formatters' => [
            \yii\web\Response::FORMAT_JSON => [
                'class' => \yii\web\JsonResponseFormatter::class,
                'prettyPrint' => YII_DEBUG,
                'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
            ],
        ],
    ],

    'user' => [
        'identityClass' => app\models\User::class,
        'enableSession' => false,
        'enableAutoLogin' => false,
    ],

    'authManager' => [
        'class' => \yii\rbac\DbManager::class,
    ],

    'urlManager' => [
        'enablePrettyUrl' => true,
        'enableStrictParsing' => true,
        'showScriptName' => false,

        'rules' => include('routes.php'),
    ],
];