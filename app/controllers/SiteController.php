<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\controllers;

use app\controllers\base\Middleware;
use yii\rest\Controller;

class SiteController extends Controller
{
    use Middleware;

    /**
     * Default action
     *
     * @return string
     */
    public function actionIndex()
    {
        return 'Resty is working!';
    }

    protected function accessRules()
    {
        return [
            [
                'allow' => true,
                'actions' => ['*'],
            ],
        ];
    }
}