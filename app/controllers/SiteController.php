<?php
/**
 * Created by Artyom Manchenkov
 * Copyright © 2015-2018 [DeepSide Interactive]
 */

namespace app\controllers;

use app\controllers\base\RestController;

class SiteController extends RestController
{
    protected function accessRules()
    {
        return [
            [
                'allow' => true,
                'actions' => ['*'],
            ]
        ];
    }

    /**
     * Default action
     *
     * @return string
     */
    public function actionIndex()
    {
        return 'Resty is working!';
    }
}