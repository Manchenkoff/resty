<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

$root_dir = realpath(__DIR__ . '/../../');

$config = [
    'id' => 'resty',

    'defaultRoute' => 'site/index',

    'basePath' => $root_dir,

    'controllerNamespace' => 'app\controllers',

    'aliases' => [
        '@app' => $root_dir . '/app',
    ],

    'bootstrap' => [
        [
            'class' => \yii\filters\ContentNegotiator::class,
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ],
    ],

    'components' => [
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
                $response = $event->sender;

                $isResponseNotNull = ($response->data !== null);
                $isResponseCodeExists = (!empty(Yii::$app->request->get('suppress_response_code')));

                if ($isResponseCodeExists && $isResponseNotNull) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'data' => $response->data,
                    ];

                    $response->statusCode = 200;
                }
            },
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
    ],

    'params' => [],
];

// adapt config to CLI (console mode)
if (php_sapi_name() == "cli") {
    unset($config['bootstrap']);
    unset($config['components']['request']);
    unset($config['components']['response']);

    $config['components']['user']['class'] = app\models\User::class;
}

return $config;
