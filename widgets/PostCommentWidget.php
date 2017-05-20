<?php

namespace app\widgets;

use app\models\CommentWidgetInterface;
use Yii;
use yii\base\Widget;
use app\models\Post;
use app\models\PostComment;
use app\models\PostCommentSearch;

class PostCommentWidget extends Widget implements CommentWidgetInterface
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
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $newComment = new PostComment();
        $commentSearchModel = new PostCommentSearch();
        $commentSearchModel->post_id = $post->id;
        $commentDataProvider = $commentSearchModel->search(Yii::$app->request->queryParams);
        if ($newComment->load(Yii::$app->request->post()) && $post->addComment($newComment)) {
            $newComment = new PostComment();
        }
        $this->params = [
            'newComment' => $newComment,
            'commentSearchModel' => $commentSearchModel,
            'commentDataProvider' => $commentDataProvider,
        ];
        $this->view = 'post-comments';
    }

    /**
     * @return string
     */
    public function run()
    {
        return $this->render($this->view, $this->params);
    }
}