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
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class PostController extends ActiveController {

    public $modelClass = 'resty\models\Post';

    /**
     * @inheritdoc
     */
    public function actions() {
        $actions = parent::actions();

        // define custom providers
        $actions['index']['prepareDataProvider'] = [$this, 'alternativeIndex'];

        return $actions;
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => function ($username, $password) {
                return User::findOne([
                    'username' => $username,
                    'password' => $password,
                ]);
            },
            'only' => [
                'desc'
            ],
            'except' => [
                // allowed actions
            ],
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['?'],
                ],
                [
                    'allow' => true,
                    'actions' => ['desc'],
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
     * @return ActiveDataProvider
     */
    public function actionDesc() {
        $this->checkAccess('desc');

        return new ActiveDataProvider([
            'pagination' => false,
            'query' => Post::find()
                ->orderBy('id desc')
                ->limit(1)
        ]);
    }
}