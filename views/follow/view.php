<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Follow $model */

$this->title = $model->idfollow;
$this->params['breadcrumbs'][] = ['label' => 'Follows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="follow-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idfollow' => $model->idfollow], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idfollow' => $model->idfollow], [
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
            'idfollow',
            'author_id',
            'user_id',
            'created_at',
        ],
    ]) ?>

</div>
