<?php

use app\models\Assets;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Assets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assets-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Assets', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idasset',
            'asset_name',
            'created_at',
            'iduser',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Assets $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idasset' => $model->idasset]);
                 }
            ],
        ],
    ]); ?>


</div>
