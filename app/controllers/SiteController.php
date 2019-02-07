<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\controllers;

use app\common\traits\ActionDependencyInjection;
use app\common\traits\Middleware;
use yii\rest\Controller;

class SiteController extends Controller
{
    use ActionDependencyInjection, Middleware;

    /**
     * Default action
     *
     * @return string
     */
    public function actionIndex()
    {
        return 'Resty is working!';
    }

    /**
     * @inheritdoc
     */
    protected function accessRules()
    {
        return [
            [
                'actions' => ['index'],
                'allow' => true,
                'roles' => ['?'],
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ];
    }

    /**
     * Array of action names without authorization
     * @return array
     */
    protected function publicActions()
    {
        return ['index'];
    }
}