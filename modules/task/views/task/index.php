<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'description:ntext',
            [
                'attribute' => 'date_start',
                'format' => ['date', 'php:d-m-Y H:i:s']
            ],
            [
                'attribute' => 'date_finish',
                'format' => ['date', 'php:d-m-Y H:i:s']
            ],
            [
                'attribute' => 'duration',
                'format' => ['duration']
            ],
            [
                'attribute' => 'status',
                'value' => function ($model, $key, $index, $column) {
                    return \app\modules\task\models\Task::$statuses[$model->status];
                },
            ],
            [
                'attribute' => 'comments',
                'label' => 'Комментарии',
                'value' => function ($model, $key, $index, $column) {
                    return count($model->comments);
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {start} {stop} {finish} {delete}',
                'buttons' => [
                    'start' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-play"></span>', $url);
                    },
                    'stop' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-stop"></span>', $url);
                    },
                    'finish' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-flag"></span>', $url);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
