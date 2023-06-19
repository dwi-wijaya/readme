<?php

use app\models\Approval;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Approvals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approval-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Approval', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idapproval',
            'idarticle',
            'status',
            'approved_date',
            'note:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Approval $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idapproval' => $model->idapproval]);
                 }
            ],
        ],
    ]); ?>


</div>
