<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

/**
 * Main HTTP application configuration file
 */
return [
    'id' => 'app-http',

    'name' => env('APP_NAME'),
    'charset' => env('APP_CHARSET'),
    'language' => env('APP_LANGUAGE'),

    'controllerNamespace' => 'app\controllers',

    'basePath' => '@app',
    'vendorPath' => '@vendor',
    'runtimePath' => '@runtime',

    /**
     * Components and modules for pre-loading
     */
    'bootstrap' => [
        'log',
        [
            'class' => yii\filters\ContentNegotiator::class,
            'formats' => ['application/json' => yii\web\Response::FORMAT_JSON],
        ],
    ],

    /**
     * Application modules
     */
    'modules' => [
        // modules configuration will be here
    ],

    /**
     * Dependency Injection container
     */
    'container' => require __DIR__ . '/container.php',

    /**
     * Application parameters
     */
    'params' => require __DIR__ . '/params.php',

    /**
     * Application components
     */
    'components' => yii\helpers\ArrayHelper::merge(
        // common application components
        require __DIR__ . '/common.php',

        // current application components only
        [
            /**
             * Web Request component
             */
            'request' => [
                'class' => manchenkov\yii\http\Request::class,
                'baseUrl' => '',
                'enableCookieValidation' => false,
                'enableCsrfValidation' => false,
                //'languages' => ['ru', 'en'],
                'parsers' => [
                    'application/json' => yii\web\JsonParser::class,
                ],
            ],

            /**
             * User identity component
             */
            'user' => [
                'identityClass' => app\models\User::class,
                'enableSession' => false,
                'enableAutoLogin' => false,
            ],

            /**
             * Web Response component
             */
            'response' => [
                'class' => yii\web\Response::class,
                'format' => yii\web\Response::FORMAT_JSON,

                'formatters' => [
                    yii\web\Response::FORMAT_JSON => [
                        'class' => yii\web\JsonResponseFormatter::class,
                        'prettyPrint' => YII_DEBUG,
                        'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                    ],
                ],

                'on beforeSend' => function ($event) {
                    /** @var \yii\web\Response $response */
                    $response = $event->sender;
                    $response->format = yii\web\Response::FORMAT_JSON;

                    if (!$response->isEmpty) {
                        $response->data = [
                            'success' => $response->isSuccessful,
                            'data' => $response->data,
                        ];

                        $response->statusCode = $response->isSuccessful ? 200 : 400;
                    }
                },
            ],
        ]
    ),
];