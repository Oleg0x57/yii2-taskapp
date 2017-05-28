<?php

namespace app\modules\comment\widgets;

use Yii;
use yii\base\Widget;
use app\modules\comment\interfaces\CommentInterface;
use app\modules\comment\interfaces\CommentableInterface;
use app\modules\comment\interfaces\FormCommentWidgetInterface;
use yii\widgets\ActiveForm;


class FormCommentWidget extends Widget implements FormCommentWidgetInterface
{
    /**
     * @var CommentableInterface
     */
    protected $entity;

    /**
     * @var ActiveForm
     */
    protected $form;

    /**
     * @var CommentInterface
     */
    protected $newComment;

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
     * @param ActiveForm $form
     * @throws \yii\base\InvalidConfigException
     */
    public function __construct(CommentableInterface $entity, ActiveForm $form)
    {
        $this->entity = $entity;
        $this->form = $form;
        $this->newComment = Yii::$container->get(CommentInterface::class);
        if ($this->newComment->load(Yii::$app->request->post()) && $this->entity->addComment($this->newComment)) {
            $this->newComment = Yii::$container->get(CommentInterface::class);
        }
        $this->params = [
            'newComment' => $this->newComment,
            'form' => $this->form,
        ];
        $this->view = 'form-comment';
    }

    /**
     * @return string
     */
    public function run()
    {
        return $this->render($this->view, $this->params);
    }
}