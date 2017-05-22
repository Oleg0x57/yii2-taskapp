<?php

namespace app\modules\task;
use yii\base\BootstrapInterface;

/**
 * task module definition class
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\task\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * @param \yii\base\Application $application
     */
    public function bootstrap($application)
    {

    }
}
