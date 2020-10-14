<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\http\Controller;
use manchenkov\yii\http\rest\Middleware;

class SiteController extends Controller
{
    use Middleware;

    /**
     * Sample home page
     * @return string
     */
    public function actionIndex(): string
    {
        return 'Resty is working!';
    }

    /**
     * @inheritDoc
     */
    protected function accessRules(): array
    {
        return [
            [
                'allow' => true,
                'roles' => ['?'],
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function publicActions(): array
    {
        return ['*'];
    }
}