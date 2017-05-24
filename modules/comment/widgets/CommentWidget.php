<?php
/**
 * Created by PhpStorm.
 * User: Ks
 * Date: 24.05.2017
 * Time: 7:20
 */

namespace app\modules\comment\widgets;

use Yii;
use yii\base\Widget;
use app\modules\comment\interfaces\CommentInterface;
use app\modules\comment\interfaces\CommentableInterface;
use app\modules\comment\interfaces\CommentSearchInterface;
use app\modules\comment\interfaces\CommentWidgetInterface;


class CommentWidget extends Widget implements CommentWidgetInterface
{
    /**
     * @var CommentableInterface
     */
    protected $entity;

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
     * @param CommentableInterface $entity
     */
    public function __construct(CommentableInterface $entity)
    {
        $this->entity = $entity;
        $this->newComment = Yii::$container->get(CommentInterface::class);
        $this->commentSearchModel = Yii::$container->get(CommentSearchInterface::class, [$entity]);
        $commentDataProvider = $this->commentSearchModel->search(Yii::$app->request->queryParams);
        if ($this->newComment->load(Yii::$app->request->post()) && $this->entity->addComment($this->newComment)) {
            $this->newComment = Yii::$container->get(CommentInterface::class);
        }
        $this->params = [
            'newComment' => $this->newComment,
            'commentSearchModel' => $this->commentSearchModel,
            'commentDataProvider' => $commentDataProvider,
        ];
        $this->view = 'comments';
    }

    /**
     * @return string
     */
    public function run()
    {
        return $this->render($this->view, $this->params);
    }
}