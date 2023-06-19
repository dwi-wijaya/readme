<?php

use app\helpers\Utils;
use app\models\mstReason;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mst Reasons';
?>
<div class="mst-reason-index">
    <div class="card card-body b-10">

        <div class="row mt-3">
            <div class="col">
                <h2 class="title-content"><?= Html::encode($this->title) ?></h2>
            </div>
            <div class="col">
                <p class="float-right">
                    <?= Html::a('<i class="fa fa-plus"></i> &nbsp;Reason', ['create'], ['class' => 'btn trans fw-300 text-upper create-btn btn-success', 'style' => 'float:right;']) ?>
                </p>
            </div>
        </div>
        <hr>


        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'idreason',
                'reason',
                [
                    'attribute' => 'status',
                    'value' => function ($m) {
                        return Utils::getFlag($m->flag);
                    },
                    'format' => 'raw',
                ],
                [
                    'class' => 'app\helpers\ButtonActionColumn',
                    'contentOptions' => ['class' => 'text-center', 'style' => 'width:160px;vertical-align:middle'],
                ],
            ],
        ]); ?>
    </div>


</div>