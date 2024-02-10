<?php

use app\models\Follow;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Follows';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="follow-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idfollow',
            'author_id',
            'user_id',
            'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Follow $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idfollow' => $model->idfollow]);
                 }
            ],
        ],
    ]); ?>


</div>
