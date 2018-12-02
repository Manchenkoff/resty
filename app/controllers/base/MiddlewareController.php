<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\controllers\base;

use yii\filters\AccessControl;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

abstract class MiddlewareController extends ActiveController
{
    abstract protected function accessRules();

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
            'tokenParam' => 'token',
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => $this->accessRules(),
        ];

        return $behaviors;
    }
}