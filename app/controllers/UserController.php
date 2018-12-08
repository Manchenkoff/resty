<?php
/**
 * Created by Artyom Manchenkov
 * Copyright © 2015-2018 [DeepSide Interactive]
 */

namespace app\controllers;

use app\controllers\base\MiddlewareController;
use app\models\User;

class UserController extends MiddlewareController
{
    public $modelClass = User::class;

    protected function accessRules()
    {
        return [
            [
                'allow' => true,
                'roles' => ['?'],
            ],
            [
                'allow' => true,
                'actions' => ['view', 'update', 'delete'],
            ],
        ];
    }
}