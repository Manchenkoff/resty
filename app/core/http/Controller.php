<?php

declare(strict_types=1);

namespace app\core\http;

use manchenkov\yii\database\ActiveCollection;
use manchenkov\yii\http\Controller as HttpController;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ArrayDataProvider;
use yii\data\DataProviderInterface;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\rest\Serializer;
use yii\web\Response;

class Controller extends HttpController
{
    /**
     * @inheritDoc
     */
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
        ];
    }

    /**
     * {@inheritdoc}
     * @throws InvalidConfigException
     */
    public function afterAction($action, $result)
    {
        $response = parent::afterAction($action, $result);

        return $this->serializeResponse($response);
    }

    /**
     * Serializes the specified data
     *
     * @param $data
     *
     * @return mixed
     * @throws InvalidConfigException
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
}