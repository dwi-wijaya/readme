<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Like $model */

$this->title = $model->idlike;
$this->params['breadcrumbs'][] = ['label' => 'Likes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="like-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idlike' => $model->idlike], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idlike' => $model->idlike], [
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
            'idlike',
            'iduser',
            'idarticle',
            'is_like:boolean',
            'created_at',
        ],
    ]) ?>

</div>
