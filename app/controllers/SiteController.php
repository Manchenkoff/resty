<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\controllers;

use app\common\traits\ActionDependencyInjection;
use yii\rest\Controller;

class SiteController extends Controller
{
    use ActionDependencyInjection;

    /**
     * Default action
     *
     * @return string
     */
    public function actionIndex()
    {
        return 'Resty is working!';
    }
}