<?php

use app\models\mstTag;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mst Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-tag-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mst Tag', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idtag',
            'tagname',
            'created_at',
            'updated_at',
            'slug',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, mstTag $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idtag' => $model->idtag]);
                 }
            ],
        ],
    ]); ?>


</div>
