<?php

namespace app\modules\post\widgets;

use Yii;
use yii\base\Widget;
use app\modules\comment\interfaces\CommentInterface;
use app\modules\comment\interfaces\CommentableInterface;
use app\modules\comment\interfaces\CommentSearchInterface;
use app\modules\comment\interfaces\CommentWidgetInterface;

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
        $this->newComment = Yii::$container->get(CommentInterface::class);
        $this->commentSearchModel = Yii::$container->get(CommentSearchInterface::class, [$post]);
        $commentDataProvider = $this->commentSearchModel->search(Yii::$app->request->queryParams);
        if ($this->newComment->load(Yii::$app->request->post()) && $this->post->addComment($this->newComment)) {
            $this->newComment = Yii::$container->get(CommentInterface::class);
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