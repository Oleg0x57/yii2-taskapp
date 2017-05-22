<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\models\PostComment;
use app\models\PostCommentSearch;
use app\models\CommentInterface;
use app\models\CommentableInterface;
use app\models\CommentSearchInterface;
use app\models\CommentWidgetInterface;

class PostCommentWidget extends Widget implements CommentWidgetInterface
{
    /**
     * @var CommentableInterface
     */
    protected $post;

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
     * @param CommentableInterface $post
     */
    public function __construct(CommentableInterface $post)
    {
        $this->post = $post;
        $this->newComment = new PostComment();
        $this->commentSearchModel = new PostCommentSearch($post);
        $commentDataProvider = $this->commentSearchModel->search(Yii::$app->request->queryParams);
        if ($this->newComment->load(Yii::$app->request->post()) && $this->post->addComment($this->newComment)) {
            $this->newComment = new PostComment();
        }
        $this->params = [
            'newComment' => $this->newComment,
            'commentSearchModel' => $this->commentSearchModel,
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