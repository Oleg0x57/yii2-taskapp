<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $newComment app\modules\comment\interfaces\CommentInterface */
/* @var $form yii\widgets\ActiveForm */
/* @var $commentSearchModel app\modules\comment\interfaces\CommentSearchInterface */
/* @var $commentDataProvider yii\data\ActiveDataProvider */

?>
    <div class="comment-form">
        <?php Pjax::begin(['id' => 'new-comment']); ?>
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

        <?= $form->field($newComment, 'message')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>
    </div>
    <div class="comment-index">
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