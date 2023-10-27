<?php

namespace app\modules\api\item\controllers;


use app\models\Item;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

class ItemController extends \yii\rest\ActiveController
{
    public $modelClass = Item::class;

    public function behaviors()
    {
		$behaviors = parent::behaviors();

        $behaviors['contentNegotiator'] = [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ]
        ];

   		$behaviors['authenticator'] = [
        	'class' => HttpBasicAuth::className(),
            'auth' => function ($username, $password) {
                $user = User::findByUsername($username);
                if ($user && $user->validatePassword($password)) {
                    return $user;
                }
            }
    	];

        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['create', 'update', 'delete'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];

        return $behaviors;
    }

}