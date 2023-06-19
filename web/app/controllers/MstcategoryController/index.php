<?php

use app\models\mstCategory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mst Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mst Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idcat',
            'name',
            'slug',
            'created_at',
            'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, mstCategory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idcat' => $model->idcat]);
                 }
            ],
        ],
    ]); ?>


</div>
