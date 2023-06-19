<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Notification $model */

$this->title = $model->idnotification;
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notification-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idnotification' => $model->idnotification], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idnotification' => $model->idnotification], [
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
            'idnotification',
            'sender_id',
            'recipient_id',
            'type',
            'idarticle',
            'created_at',
            'text',
            'icon',
            'route',
            'status',
        ],
    ]) ?>

</div>
