<?php
/**
 * Created by Artyom Manchenkov
 * Copyright © 2015-2018 [DeepSide Interactive]
 */

namespace resty\controllers;

use Yii;
use resty\models\User;
use yii\filters\AccessControl;
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
        $behaviors['authenticator'] = Yii::$app->params['basic_auth'];
    
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