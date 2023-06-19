<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Trending $model */

$this->title = $model->idtrend;
$this->params['breadcrumbs'][] = ['label' => 'Trendings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trending-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idtrend' => $model->idtrend], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idtrend' => $model->idtrend], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idtrend',
            'iduser',
            'idarticle',
            'created_at',
            'liked:boolean',
        ],
    ]) ?>

</div>
