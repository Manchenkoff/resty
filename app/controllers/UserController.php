<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
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