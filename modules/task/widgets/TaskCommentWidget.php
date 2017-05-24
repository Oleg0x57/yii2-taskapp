<?php

namespace app\modules\task\widgets;

use Yii;
use yii\base\Widget;
use app\modules\comment\interfaces\CommentInterface;
use app\modules\comment\interfaces\CommentableInterface;
use app\modules\comment\interfaces\CommentSearchInterface;
use app\modules\comment\interfaces\CommentWidgetInterface;

class TaskCommentWidget extends Widget implements CommentWidgetInterface
{
    /**
     * @var CommentableInterface
     */
    protected $task;

    /**
     * @var CommentInterface
     */
    protected $newComment;

    /**
     * @var CommentSearchInterface
     */
    protected $commentSearchModel;

    /**
     * @var string
     */
    protected $view = '';

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param CommentableInterface $task
     */
    public function __construct(CommentableInterface $task)
    {
        $this->task = $task;
        $this->newComment = Yii::$container->get(CommentInterface::class);
        $this->commentSearchModel = Yii::$container->get(CommentSearchInterface::class, [$task]);
        $commentDataProvider = $this->commentSearchModel->search(Yii::$app->request->queryParams);
        if ($this->newComment->load(Yii::$app->request->post()) && $this->task->addComment($this->newComment)) {
            $this->newComment = Yii::$container->get(CommentInterface::class);
        }
        $this->params = [
            'newComment' => $this->newComment,
            'commentSearchModel' => $this->commentSearchModel,
            'commentDataProvider' => $commentDataProvider,
        ];
        $this->view = 'task-comments';
    }

    /**
     * @return string
     */
    public function run()
    {
        return $this->render($this->view, $this->params);
    }
}