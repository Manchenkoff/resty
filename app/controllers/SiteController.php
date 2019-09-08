<?php

namespace app\controllers;

use app\core\http\Controller;
use manchenkov\yii\http\rest\Middleware;

class SiteController extends Controller
{
    use Middleware;

    /**
     * @inheritDoc
     */
    protected function accessRules()
    {
        return [
            [
                'allow' => true,
                'roles' => ['?'],
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function publicActions()
    {
        return ['*'];
    }

    /**
     * Sample home page
     * @return string
     */
    public function actionIndex()
    {
        return 'Resty is working!';
    }
}