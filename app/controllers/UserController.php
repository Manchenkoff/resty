<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\controllers;

use app\controllers\base\Middleware;
use app\models\User;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    use Middleware;
    
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