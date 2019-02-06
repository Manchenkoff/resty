<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

use app\models\User;
use yii\rbac\DbManager;
use yii\web\JsonParser;
use yii\web\JsonResponseFormatter;
use yii\web\Response;

return [
    'db' => include('db.php'),

    'request' => [
        'enableCookieValidation' => false,
        'parsers' => [
            'application/json' => JsonParser::class,
        ],
    ],

    'response' => [
        'class' => Response::class,
        'format' => Response::FORMAT_JSON,
        'formatters' => [
            Response::FORMAT_JSON => [
                'class' => JsonResponseFormatter::class,
                'prettyPrint' => YII_DEBUG,
                'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
            ],
        ],
        // custom response format
        'on beforeSend' => function ($event) {
            /** @var \yii\web\Response $response */
            $response = $event->sender;
            $response->format = Response::FORMAT_JSON;

            if (!$response->isEmpty) {
                $response->data = [
                    'success' => $response->isSuccessful,
                    'data' => $response->data,
                ];

                $response->statusCode = $response->isSuccessful ? 200 : 400;
            }
        },
    ],

    'user' => [
        'identityClass' => User::class,
        'enableSession' => false,
        'enableAutoLogin' => false,
    ],

    'authManager' => [
        'class' => DbManager::class,
    ],

    'urlManager' => [
        'enablePrettyUrl' => true,
        'enableStrictParsing' => true,
        'showScriptName' => false,

        'rules' => include('routes.php'),
    ],
];