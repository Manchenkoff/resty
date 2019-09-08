<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

namespace app\core\http;

use manchenkov\yii\database\ActiveCollection;
use manchenkov\yii\http\Controller as HttpController;
use Yii;
use yii\base\Action;
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
    public function behaviors()
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
                $data = new ArrayDataProvider([
                    'models' => $collection->all(),
                ]);
            }
        }

        return Yii::createObject(Serializer::class)->serialize($data);
    }

    /**
     * Normalizes the response
     *
     * @param Action $action
     * @param mixed $result
     *
     * @return mixed
     * @throws InvalidConfigException
     */
    public function afterAction($action, $result)
    {
        $response = parent::afterAction($action, $result);

        return $this->serializeResponse($response);
    }

    /**
     * Sends response as an error
     *
     * @param $data
     *
     * @return mixed
     */
    protected function error($data)
    {
        app()->response->setStatusCode(400, 'Error');

        return is_string($data) ? ['error' => $data] : $data;
    }
}