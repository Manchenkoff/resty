<?php
/**
 * Created by Artyom Manchenkov
 * Copyright © 2015-2018 [DeepSide Interactive]
 */

namespace resty\controllers;

use resty\models\User;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

class UserController extends ActiveController {
    
    public $modelClass = 'resty\models\User';
    
    /**
     * @inheritdoc
     */
    public function behaviors() {
        $behaviors = parent::behaviors();
    
        /**
         * Auth settings
         */
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::class,
            'auth' => 'resty\models\User::basicAuth',
            'only' => [],
            'except' => ['index'],
        ];
    
        /**
         * Access settings
         */
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['?'],
                ],
                [
                    'allow' => true,
                    'actions' => ['view', 'update', 'delete'],
                    'roles' => ['manageUser'],
                ],
            ],
        ];
        
        return $behaviors;
    }
    
}