<?php

use app\models\Bookmark;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Bookmarks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookmark-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Bookmark', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idbookmark',
            'idarticle',
            'iduser',
            'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Bookmark $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idbookmark' => $model->idbookmark]);
                 }
            ],
        ],
    ]); ?>


</div>
