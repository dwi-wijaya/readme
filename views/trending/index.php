<?php

use app\models\Trending;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Trendings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trending-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Trending', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idtrend',
            'iduser',
            'idarticle',
            'created_at',
            'liked:boolean',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Trending $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idtrend' => $model->idtrend]);
                 }
            ],
        ],
    ]); ?>


</div>
