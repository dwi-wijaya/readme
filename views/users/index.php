<?php

use app\models\Users;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
?>
<div class="users-index">
    <div class="card card-body b-10">

        <div class="row mt-3">
            <div class="col">
                <h2 class="title-content"><?= Html::encode($this->title) ?></h2>
            </div>
            <div class="col">
                <p class="float-right">
                    <?= Html::a('<i class="fa fa-plus"></i> &nbsp;User', ['create'], ['class' => 'btn trans fw-300 text-upper create-btn btn-success', 'style' => 'float:right;']) ?>
                </p>
            </div>
        </div>
        <hr>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'username',
                'first_name',
                'last_name',
                // 'password',
                // 'bio',
                //'role',
                //'authKey',
                //'created_at',
                //'updated_at',
                //'lastlogin',
                [
                    'class' => 'app\helpers\ButtonActionColumn',
                    'contentOptions' => ['class' => 'text-center', 'style' => 'width:160px;vertical-align:middle'],
                    
                ],
            ],
        ]); ?>
    </div>


</div>