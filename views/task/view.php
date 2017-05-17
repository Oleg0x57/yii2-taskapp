<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $task app\models\Task */
/* @var $newComment app\models\TaskComment */
/* @var $form yii\widgets\ActiveForm */
/* @var $commentSearchModel app\models\TaskCommentSearch */
/* @var $commentDataProvider yii\data\ActiveDataProvider */

$this->title = $task->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="task-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Update', ['update', 'id' => $task->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $task->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $task,
            'attributes' => [
                'id',
                'title',
                'description:ntext',
                'date_start',
                'date_finish',
                'duration',
                'status',
            ],
        ]) ?>

    </div>
    <div class="task-comment-form">
        <?php Pjax::begin(['id' => 'new-comment']); ?>
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

        <?= $form->field($newComment, 'message')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>
    </div>
    <div class="task-comment-index">
        <?php Pjax::begin(['id' => 'comments']); ?>
        <?= GridView::widget([
            'dataProvider' => $commentDataProvider,
            'filterModel' => $commentSearchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'message',
                'date',
            ],
        ]); ?>
        <?php Pjax::end() ?>
    </div>
<?php
$this->registerJs(<<<JS
    $("document").ready(function(){
            $("#new-comment").on("pjax:end", function() {
            $.pjax.reload({container:"#comments"});
        });
    });
JS
);