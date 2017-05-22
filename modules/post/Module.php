<?php

namespace app\modules\post;

use yii\base\BootstrapInterface;

/**
 * post module definition class
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\post\controllers';

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
