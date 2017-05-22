<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'text:ntext',
            [
                'attribute' => 'date',
                'format' => ['date', 'php:d-m-Y H:i:s']
            ],
            [
                'attribute' => 'status',
                'value' => function ($model, $key, $index, $column) {
                    return \app\modules\post\models\Post::$statuses[$model->status];
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
                'template' => '{view} {update} {publish} {delete}',
                'buttons' => [
                    'publish' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
