<?php

use app\models\Guides;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Guides';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guides-index">

    <div class="card card-body ">

        <div class="row mt-3">
            <div class="col">
                <h2 class="title-content"><?= Html::encode($this->title) ?></h2>
            </div>
            <div class="col">
                <p class="float-right">
                    <?= Html::a('<i class="fa fa-plus"></i> &nbsp; Guide', ['create'], ['class' => 'btn trans fw-300 text-upper create-btn btn-success', 'style' => 'float:right;']) ?>
                </p>
            </div>
        </div>

        <hr>


        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'idguide',
                'title',
                'thumbnail',
                'description',
                'author',
                //'level',
                //'created_at',
                [
                    'class' => 'app\helpers\ButtonActionColumn',
                    'contentOptions' => ['class' => 'text-center', 'style' => 'width:160px;vertical-align:middle'],
                ],
            ],
        ]); ?>

    </div>
</div>