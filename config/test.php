<?php

use yii\web\JsonParser;
use yii\web\JsonResponseFormatter;
use yii\web\Response;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/test_db.php';

$config = [
    'id' => 'reezonly-api-test',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'api\item' => [
            'basePath' => '@app/modules/api/item',
            'class' => \app\modules\api\item\Module::class,
        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'super-secret-cookie',
            'parsers' => [
                'application/json' => JsonParser::class,
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'loginUrl' => null,
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                'GET,HEAD api/items' => 'api\item/items/index',
                'api/items' => 'api\item/items/options',

                'PUT,PATCH api/item/<id>' => 'api\item/item/update',
                'DELETE api/item/<id>' => 'api\item/item/delete',
                'GET,HEAD api/item/<id>' => 'api\item/item/view',
                'POST api/item' => 'api\item/item/create',
                'api/item/<id>' => 'api\item/item/options',
                'api/item' => 'api\item/item/options',
            ],
        ],
    ],
    'params' => $params,
];

return $config;
