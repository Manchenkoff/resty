<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\controllers;

use app\common\traits\Middleware;
use app\models\Post;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class PostController extends ActiveController
{
    use Middleware;

    public $modelClass = Post::class;

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
}