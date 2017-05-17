<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\models\Post;
use app\models\PostComment;
use app\models\PostCommentSearch;

class PostCommentWidget extends Widget
{
    protected $params = [];

    public function __construct(Post $post)
    {
        $newComment = new PostComment();
        $newComment->post_id = $post->id;
        $commentSearchModel = new PostCommentSearch();
        $commentSearchModel->post_id = $post->id;
        $commentDataProvider = $commentSearchModel->search(Yii::$app->request->queryParams);
        if ($newComment->load(Yii::$app->request->post()) && $newComment->save()) {
            $newComment = new PostComment();
            $newComment->post_id = $post->id;
        }
        $this->params = [
            'newComment' => $newComment,
            'commentSearchModel' => $commentSearchModel,
            'commentDataProvider' => $commentDataProvider,
        ];
    }

    public function run()
    {
        return $this->render('post-comments', $this->params);
    }
}