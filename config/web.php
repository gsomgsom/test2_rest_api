<?php

use yii\web\JsonParser;
use yii\web\JsonResponseFormatter;
use yii\web\Response;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'reezonly-api',
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
        'admin\admin' => [
            'basePath' => '@app/modules/admin/admin',
            'class' => \app\modules\admin\admin\Module::class,
        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'super-secret-cookie',
            'parsers' => [
                'application/json' => JsonParser::class,
            ],
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'class' => Response::class,
            'formatters' => [
                Response::FORMAT_JSON => [
                    'class' => JsonResponseFormatter::class,
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
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

                '' => 'admin\admin/site/index',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
