<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

namespace app\controllers;

use app\core\http\Controller;
use app\models\User;
use manchenkov\yii\database\ActiveRecord;
use manchenkov\yii\http\rest\Middleware;
use Throwable;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;

/**
 * Class UserController
 * @package app\controllers
 *
 * Routes:
 *    'GET users' => 'user/index',
 *    'POST users' => 'user/store',
 *    'GET users/<id>' => 'user/view',
 *    'POST users/<id>' => 'user/update',
 *    'DELETE users/<id>' => 'user/delete',
 */
class UserController extends Controller
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
                'actions' => ['index', 'store'],
                'roles' => ['?'],
            ],
            [
                'allow' => true,
                'actions' => ['view', 'update'],
                'roles' => ['@'],
            ],
            [
                'allow' => true,
                'actions' => ['delete'],
                'roles' => ['manager'],
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function publicActions()
    {
        return ['index', 'store'];
    }

    /**
     * Shows user list
     * @return ActiveDataProvider
     */
    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => User::find(),
        ]);
    }

    /**
     * Creates a new user
     * @return User|mixed
     */
    public function actionStore()
    {
        $user = new User();

        if ($user->load(request()->post())) {
            if ($user->validate()) {
                $user->save();
            }

            return $user;
        }

        return $this->error('Invalid data');
    }

    /**
     * Returns the user model
     *
     * @param User $user
     *
     * @return ActiveRecord|null
     * @throws NotFoundHttpException
     */
    public function actionView(User $user)
    {
        return $user;
    }

    /**
     * Updates the user with passed parameters
     *
     * @param User $user
     *
     * @return ActiveRecord|mixed|null
     * @throws NotFoundHttpException
     */
    public function actionUpdate(User $user)
    {
        if ($user->load(request()->post())) {
            if ($user->validate()) {
                $user->save();
            }

            return $user;
        }

        return $this->error('Invalid data');
    }

    /**
     * Deletes the user model
     *
     * @param User $user
     *
     * @return ActiveRecord|null
     * @throws Throwable
     * @throws StaleObjectException
     * @throws NotFoundHttpException
     */
    public function actionDelete(User $user)
    {
        $user->delete();

        return $user;
    }
}