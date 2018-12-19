<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
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