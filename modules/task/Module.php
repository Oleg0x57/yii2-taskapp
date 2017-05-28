<?php

namespace app\modules\task;

use Yii;
use app\modules\comment\interfaces\CommentableInterface;
use app\modules\comment\interfaces\CommentInterface;
use app\modules\comment\interfaces\CommentSearchInterface;
use app\modules\comment\interfaces\CommentWidgetInterface;
use app\modules\comment\interfaces\FormCommentWidgetInterface;
use app\modules\task\models\Task;
use app\modules\task\models\TaskComment;
use app\modules\task\models\TaskCommentSearch;
use app\modules\comment\widgets\CommentWidget;
use app\modules\comment\widgets\FormCommentWidget;
use yii\base\Event;

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
        Yii::$container->set(CommentableInterface::class, Task::class);
        Yii::$container->set(CommentInterface::class, TaskComment::class);
        Yii::$container->set(CommentSearchInterface::class, TaskCommentSearch::class);
        Yii::$container->set(CommentWidgetInterface::class, CommentWidget::class);
        Yii::$container->set(FormCommentWidgetInterface::class, FormCommentWidget::class);
        $commentable = Yii::$container->get(CommentableInterface::class);
        $comment = Yii::$container->get(CommentInterface::class);
        Event::on($commentable::className(), $commentable::EVENT_AFTER_INSERT, function ($event) use ($comment, $commentable) {
            $comment->load(Yii::$app->request->post());
            $event->sender->addComment($comment);
        });
    }
}
