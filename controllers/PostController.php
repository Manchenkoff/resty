<?php

namespace resty\controllers;

use yii\rest\ActiveController;

class PostController extends ActiveController {

    public $modelClass = 'resty\models\Post';

    public function behaviors() {
        // удаляем rateLimiter, требуется для аутентификации пользователя
        $behaviors = parent::behaviors();
        unset($behaviors['rateLimiter']);
        return $behaviors;
    }
}