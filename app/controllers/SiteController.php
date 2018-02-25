<?php
/**
 * Created by Artyom Manchenkov
 * Copyright © 2015-2018 [DeepSide Interactive]
 */

namespace resty\controllers;

use yii\web\Controller;

class SiteController extends Controller {
    
    /**
     * Default action
     *
     * @return string
     */
    public function actionIndex() {
        return 'Resty is working!';
    }
}