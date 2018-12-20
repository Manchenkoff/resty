<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\controllers\base;

use yii\filters\AccessControl;
use yii\filters\auth\QueryParamAuth;

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
            'class' => QueryParamAuth::class,
            'tokenParam' => 'token',
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => $this->accessRules(),
        ];

        return $behaviors;
    }

    /**
     * AccessControl rules
     * @return array
     *
     * @example return [
     *     [
     *         'allow' => true|false,
     *         'roles' => ['?'],
     *         'action' => ['index', 'action']
     *     ],
     * ];
     */
    abstract protected function accessRules();
}