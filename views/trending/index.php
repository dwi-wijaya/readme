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
    <div class="card card-body">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'iduser',
                'idarticle',
                'created_at',
                'liked:boolean',
            ],
        ]); ?>


    </div>
</div>