<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\task\models\Task */
/* @var $comment app\modules\comment\interfaces\CommentInterface */

$this->title = 'Create Task';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'comment' => $comment,
    ]) ?>

</div>
