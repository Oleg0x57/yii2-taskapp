<?php

namespace app\widgets;

use app\models\CommentWidgetInterface;
use Yii;
use yii\base\Widget;
use app\models\TaskComment;
use app\models\TaskCommentSearch;
use app\models\CommentInterface;
use app\models\CommentableInterface;
use app\models\CommentSearchInterface;

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
        $this->newComment = new TaskComment();
        $this->commentSearchModel = new TaskCommentSearch($task);
        $commentDataProvider = $this->commentSearchModel->search(Yii::$app->request->queryParams);
        if ($this->newComment->load(Yii::$app->request->post()) && $this->task->addComment($this->newComment)) {
            $this->newComment = new TaskComment();
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