<?php

declare(strict_types=1);

namespace app\core\http;

use manchenkov\yii\database\ActiveCollection;
use Yii;
use yii\data\ArrayDataProvider;
use yii\data\DataProviderInterface;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\rest\Serializer;
use yii\web\Controller as HttpController;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

abstract class Controller extends HttpController
{
    public function behaviors(): array
    {
        return [
            RateLimiter::class,

            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],

            'access' => [
                'class' => AccessControl::class,
                'rules' => $this->accessRules(),
                'denyCallback' => static function () {
                    throw new ForbiddenHttpException("You don't have permission to access this page");
                },
            ],

            'authenticator' => [
                'class' => CompositeAuth::class,
                'except' => $this->publicActions(),
                'authMethods' => [
                    [
                        'class' => QueryParamAuth::class,
                        'tokenParam' => 'token',
                    ],
                    [
                        'class' => HttpBearerAuth::class,
                    ],
                ],
            ],
        ];
    }

    public function afterAction($action, $result)
    {
        $response = parent::afterAction($action, $result);

        return $this->serializeResponse($response);
    }

    /**
     * @param $data
     *
     * @return array|mixed|null
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    protected function serializeResponse($data)
    {
        if ($data instanceof DataProviderInterface) {
            $collection = $data->getModels();

            if ($collection instanceof ActiveCollection) {
                $data = new ArrayDataProvider(
                    [
                        'models' => $collection->all(),
                    ]
                );
            }
        }

        return Yii::createObject(Serializer::class)->serialize($data);
    }

    /**
     * Sends response as an error
     *
     * @param $data
     *
     * @return mixed
     */
    protected function error($data): array
    {
        app()->response->setStatusCode(400, 'Error');

        return is_string($data) ? ['error' => $data] : $data;
    }

    /**
     * Array of actions without authentication
     * @return array
     */
    protected function publicActions(): array
    {
        return [];
    }

    /**
     * AccessControl rules
     * @return array
     *
     * @example
     * ```php
     * return [
     *     [
     *         'allow' => true|false,
     *         'roles' => ['?'],
     *         'action' => ['index', 'action']
     *     ],
     * ];
     * ```
     */
    abstract protected function accessRules(): array;
}
