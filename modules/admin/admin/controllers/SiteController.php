<?php

namespace app\modules\admin\admin\controllers;


use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator'] = [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'text/html' => \yii\web\Response::FORMAT_HTML,
            ]
        ];

        return $behaviors;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
