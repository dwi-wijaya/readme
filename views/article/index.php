<?php

use app\models\Article;
use app\widgets\FreezableGridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Article';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    th a {
        color: black
    }
</style>
<div class="article-index">
    <div class="card card-body b-10">

        <div class="row mt-3">
            <div class="col">
                <h2 class="title-content"><?= Html::encode($this->title) ?></h2>
            </div>
            <div class="col">
                <p class="float-right">
                    <?= Html::a('<i class="fa fa-plus"></i> &nbsp; Article', ['create'], ['class' => 'btn trans fw-300 text-upper create-btn btn-success', 'style' => 'float:right;']) ?>
                </p>
            </div>
        </div>
        <hr>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'title',
                'subtitle',
                'created_at',
                'tag',
                // 'content:ntext',
                // 'thumbnail',
                'cetegory.category',
                [
                    'class' => 'app\helpers\ButtonActionColumn',
                    'contentOptions' => ['class' => 'text-center', 'style' => 'width:160px;vertical-align:middle'],
                    'urlCreator' => function ($action, Article $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->idarticle]);
                    }
                ],
            ],
        ]); ?>
    </div>

</div>