<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace app\controllers\console;

use yii\console\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        echo 'TestController@index' . PHP_EOL;
    }
}