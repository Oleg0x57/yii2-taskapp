<?php

namespace app\widgets;

use app\models\CommentWidgetInterface;
use Yii;
use yii\base\Widget;
use app\models\Task;
use app\models\TaskComment;
use app\models\TaskCommentSearch;

class TaskCommentWidget extends Widget implements CommentWidgetInterface
{
    /**
     * @var string
     */
    protected $view = '';

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $newComment = new TaskComment();
        $commentSearchModel = new TaskCommentSearch($task);
        $commentDataProvider = $commentSearchModel->search(Yii::$app->request->queryParams);
        if ($newComment->load(Yii::$app->request->post()) && $task->addComment($newComment)) {
            $newComment = new TaskComment();
        }
        $this->params = [
            'newComment' => $newComment,
            'commentSearchModel' => $commentSearchModel,
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