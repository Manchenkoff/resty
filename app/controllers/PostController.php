<?php
/**
 * Created by Artyom Manchenkov
 * Copyright © 2015-2018 [DeepSide Interactive]
 */

namespace app\controllers;

use app\controllers\base\MiddlewareController;
use app\models\Post;
use yii\data\ActiveDataProvider;

class PostController extends MiddlewareController
{
    public $modelClass = Post::class;

    protected function accessRules()
    {
        return [
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
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $actions = parent::actions();

        // define custom actionIndex provider
        $actions['index']['prepareDataProvider'] = [$this, 'alternativeIndex'];

        return $actions;
    }

    /**
     * Custom Index action data provider
     *
     * @return ActiveDataProvider
     */
    public function alternativeIndex()
    {
        return new ActiveDataProvider([
            'query' => Post::find()->orderBy('id desc'),
        ]);
    }

    /**
     * Post API request action sample
     *
     * @return ActiveDataProvider
     */
    public function actionLimit()
    {
        return new ActiveDataProvider([
            'pagination' => false,
            'query' => Post::find()
                ->orderBy('id desc')
                ->limit(1),
        ]);
    }
}