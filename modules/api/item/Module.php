<?php

namespace app\modules\api\item;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\api\item\controllers';

    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
    }
}
