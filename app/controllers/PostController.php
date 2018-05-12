<?php
/**
 * Created by Artyom Manchenkov
 * Copyright © 2015-2018 [DeepSide Interactive]
 */

namespace resty\controllers;

use resty\models\Post;
use resty\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class PostController extends ActiveController {

    public $modelClass = 'resty\models\Post';

    /**
     * @inheritdoc
     */
    public function actions() {
        $actions = parent::actions();

        // define custom actionIndex provider
        $actions['index']['prepareDataProvider'] = [$this, 'alternativeIndex'];

        return $actions;
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $behaviors = parent::behaviors();
    
        /**
         * Auth settings (with 'token' param in request)
         */
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
            'tokenParam' => 'token',
            'only' => [
                // disallowed actions
                'limit',
            ],
            'except' => [
                // allowed actions
            ],
        ];
    
        /**
         * Access controller settings
         */
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                // allow for guests
                [
                    'allow' => true,
                    'roles' => ['?'],
                ],
                // allow for users
                [
                    'allow' => true,
                    'actions' => ['limit'],
                    'roles' => ['@'],
                ]
            ],
        ];

        return $behaviors;
    }

    /**
     * Custom Index action data provider
     *
     * @return ActiveDataProvider
     */
    public function alternativeIndex() {
        return new ActiveDataProvider([
            'query' => Post::find()->orderBy('id desc'),
        ]);
    }

    /**
     * Post API request action sample
     *
     * @return ActiveDataProvider
     * @throws \yii\web\ForbiddenHttpException
     */
    public function actionLimit() {
        $this->checkAccess('limit');

        return new ActiveDataProvider([
            'pagination' => false,
            'query' => Post::find()
                ->orderBy('id desc')
                ->limit(1)
        ]);
    }
}