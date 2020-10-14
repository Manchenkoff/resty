<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\http\Controller;
use app\models\Post;
use manchenkov\yii\database\ActiveRecord;
use manchenkov\yii\http\rest\Middleware;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;

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
     * Shows posts list
     * @return ActiveDataProvider
     */
    public function actionIndex(): ActiveDataProvider
    {
        return new ActiveDataProvider(
            [
                'query' => Post::find(),
            ]
        );
    }

    /**
     * Creates a new post
     * @return Post|mixed
     */
    public function actionStore(): Post
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
     * @param Post $post
     *
     * @return ActiveRecord|null
     */
    public function actionView(Post $post)
    {
        return $post;
    }

    /**
     * Updates the post with passed parameters
     *
     * @param Post $post
     *
     * @return ActiveRecord|mixed|null
     */
    public function actionUpdate(Post $post)
    {
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
     * @param Post $post
     *
     * @return ActiveRecord|null
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(Post $post)
    {
        $post->delete();

        return $post;
    }

    /**
     * @inheritDoc
     */
    protected function accessRules(): array
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
    protected function publicActions(): array
    {
        return ['index'];
    }
}