<?php

namespace app\modules\task;

use Yii;
use app\models\CommentInterface;
use app\models\CommentSearchInterface;
use app\models\CommentWidgetInterface;
use app\modules\task\models\TaskComment;
use app\modules\task\models\TaskCommentSearch;
use app\modules\task\widgets\TaskCommentWidget;

/**
 * task module definition class
 */
class Module extends \yii\base\Module
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
        Yii::$container->set(CommentInterface::class, TaskComment::class);
        Yii::$container->set(CommentSearchInterface::class, TaskCommentSearch::class);
        Yii::$container->set(CommentWidgetInterface::class, TaskCommentWidget::class);
    }
}
