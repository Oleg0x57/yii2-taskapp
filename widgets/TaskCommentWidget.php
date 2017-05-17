<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\models\Task;
use app\models\TaskComment;
use app\models\TaskCommentSearch;

class TaskCommentWidget extends Widget
{
    protected $params = [];

    public function __construct(Task $task)
    {
        $newComment = new TaskComment();
        $newComment->task_id = $task->id;
        $commentSearchModel = new TaskCommentSearch();
        $commentSearchModel->task_id = $task->id;
        $commentDataProvider = $commentSearchModel->search(Yii::$app->request->queryParams);
        if ($newComment->load(Yii::$app->request->post()) && $newComment->save()) {
            $newComment = new TaskComment();
            $newComment->task_id = $task->id;
        }
        $this->params = [
            'newComment' => $newComment,
            'commentSearchModel' => $commentSearchModel,
            'commentDataProvider' => $commentDataProvider,
        ];
    }

    public function run()
    {
        return $this->render('comments', $this->params);
    }
}