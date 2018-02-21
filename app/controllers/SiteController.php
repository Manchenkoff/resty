<?php
/**
 * Created by Artyom Manchenkov
 * Copyright © 2015-2018 [DeepSide Interactive]
 */

namespace resty\controllers;

use yii\web\Controller;

class SiteController extends Controller {

    public function actionIndex() {
        return 'Hello World!';
    }
}