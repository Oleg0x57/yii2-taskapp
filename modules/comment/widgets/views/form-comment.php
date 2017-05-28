<?php

/* @var $this yii\web\View */
/* @var $newComment app\modules\comment\interfaces\CommentInterface */
/* @var $form yii\widgets\ActiveForm */

?>
<?= $form->field($newComment, 'message')->textInput(['maxlength' => true]) ?>
