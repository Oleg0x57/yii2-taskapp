<?php

namespace app\modules\post;

use Yii;
use app\modules\post\models\PostComment;
use app\modules\post\models\PostCommentSearch;
use app\modules\post\widgets\PostCommentWidget;
use app\modules\comment\interfaces\CommentInterface;
use app\modules\comment\interfaces\CommentSearchInterface;
use app\modules\comment\interfaces\CommentWidgetInterface;

/**
 * post module definition class
 */
class Module extends \yii\base\Module
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
        Yii::$container->set(CommentInterface::class, PostComment::class);
        Yii::$container->set(CommentSearchInterface::class, PostCommentSearch::class);
        Yii::$container->set(CommentWidgetInterface::class, PostCommentWidget::class);
    }
}
