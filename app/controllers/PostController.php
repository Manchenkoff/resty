<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

namespace app\controllers;

use app\core\http\Controller;
use app\models\Post;
use manchenkov\yii\database\ActiveRecord;
use manchenkov\yii\http\rest\Middleware;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;

/**
 * Class PostController
 * @package app\controllers
 *
 * Routes:
 *    'GET posts' => 'post/index',
 *    'POST posts' => 'post/store',
 *    'GET posts/<id>' => 'post/view',
 *    'POST posts/<id>' => 'post/update',
 *    'DELETE posts/<id>' => 'post/delete',
 */
class PostController extends Controller
{
    use Middleware;

    /**
     * @inheritDoc
     */
    protected function accessRules()
    {
        return [
            [
                'allow' => true,
                'actions' => ['index'],
                'roles' => ['?'],
            ],
            [
                'allow' => true,
                'roles' => ['manager'],
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function publicActions()
    {
        return ['index'];
    }

    /**
     * Shows posts list
     * @return ActiveDataProvider
     */
    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => Post::find(),
        ]);
    }

    /**
     * Creates a new post
     * @return Post|mixed
     */
    public function actionStore()
    {
        $post = new Post();

        if ($post->load(request()->post())) {
            if ($post->validate()) {
                $post->save();
            }

            return $post;
        }

        return $this->error('Invalid data');
    }

    /**
     * Returns the post model
     *
     * @param $id
     *
     * @return ActiveRecord|null
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return Post::findOrFail(['id' => $id]);
    }

    /**
     * Updates the post with passed parameters
     *
     * @param $id
     *
     * @return ActiveRecord|mixed|null
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $post = Post::findOrFail(['id' => $id]);

        if ($post->load(request()->post())) {
            if ($post->validate()) {
                $post->save();
            }

            return $post;
        }

        return $this->error('Invalid data');
    }

    /**
     * Deletes the post model
     *
     * @param $id
     *
     * @return ActiveRecord|null
     * @throws Throwable
     * @throws StaleObjectException
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $post = Post::findOrFail(['id' => $id]);

        $post->delete();

        return $post;
    }
}