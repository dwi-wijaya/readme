<?php

use app\models\mstMenu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Menu;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Menu';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="navbar-index">
    <div class="card card-body ">

        <div class="row mt-3">
            <div class="col">
                <h2 class="title-content"><?= Html::encode($this->title) ?></h2>
            </div>
            <div class="col">
                <p class="float-right">
                    <?= Html::a('<i class="fa fa-plus"></i> &nbsp; Menu', ['create'], ['class' => 'btn trans fw-300 text-upper create-btn btn-success', 'style' => 'float:right;']) ?>
                </p>
            </div>
        </div>

        <hr>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'table table-hover table-striped table-bordered'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'type',
                    'value' => function ($m) {
                        if ($m->type == 0) {
                            return "<span class= 'badge badge-secondary p-2'>GUEST</span>";
                        } else {
                            return "<span class= 'badge badge-success p-2'>ADMIN</span>";
                        }
                    },
                    'format' => 'html',
                ],
                'name',
                [
                    'attribute' => 'url',
                    'value' => function ($m) {
                        return Html::a($m['url'], Url::to($m['url']));
                    },
                    'format' => 'html'
                ],
                // 'url:url',
                'order',
                [
                    'class' => 'app\helpers\ButtonActionColumn',
                    'contentOptions' => ['class' => 'text-center', 'style' => 'width:160px;vertical-align:middle'],
                    'urlCreator' => function ($action, mstMenu $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->idmenu]);
                    }
                ],
            ],
        ]); ?>
    </div>


</div>