<?php

namespace app\modules\api\item\controllers;


use app\models\Item;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Response;

class ItemsController extends \yii\rest\ActiveController
{
    public $modelClass = Item::class;

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator'] = [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ]
        ];

        return $behaviors;
    }

    public function actions()
    {
        // List only
        $actions = parent::actions();
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);

        $actions['index'] = [
            'class' => 'yii\rest\IndexAction',
            'modelClass' => $this->modelClass,
            'checkAccess' => [$this, 'checkAccess'],

            'prepareDataProvider' => function ($action, $filter) {
                $model = new $this->modelClass;
                $query = $model::find();

                // Search
                if (isset($_GET['query'])) {
                    $model->setAttribute('name', @$_GET['query']);
                    $query->andFilterWhere(['like', 'name', $model->name]);
                }

                // Sort
                $orderBy = (isset($_GET['orderBy']) && in_array($_GET['orderBy'], ['id', 'name'])) ? $_GET['orderBy'] : 'id';
                $order = (isset($_GET['order']) && in_array($_GET['order'], ['asc', 'desc'])) ? $_GET['order'] : 'asc';
                $query->orderBy([$orderBy => $order]);

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'sort' => ['attributes' => ['id', 'name']],
                ]);

                return $dataProvider;
            }
        ];

        return $actions;
    }
}