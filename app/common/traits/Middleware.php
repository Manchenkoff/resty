<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\common\traits;

use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\web\ForbiddenHttpException;

trait Middleware
{
    /**
     * Basic behaviors: TokenAuth, AccessControl
     * @return mixed
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'except' => $this->publicActions(),
            'authMethods' => [
                [
                    'class' => QueryParamAuth::class,
                    'tokenParam' => 'token',
                ],
                [
                    'class' => HttpBearerAuth::class,
                ],
            ],
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => $this->accessRules(),
            'denyCallback' => function () {
                throw new ForbiddenHttpException("You don't have permission to access this page");
            }
        ];

        return $behaviors;
    }

    /**
     * AccessControl rules
     * @return array
     *
     * @example
     * ```php
     * return [
     *     [
     *         'allow' => true|false,
     *         'roles' => ['?'],
     *         'action' => ['index', 'action']
     *     ],
     * ];
     * ```
     */
    abstract protected function accessRules();

    /**
     * Array of actions without authentication
     * @return array
     */
    protected function publicActions()
    {
        return [];
    }
}