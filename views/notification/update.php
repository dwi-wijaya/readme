<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Notification $model */

$this->title = 'Update Notification: ' . $model->idnotification;
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idnotification, 'url' => ['view', 'idnotification' => $model->idnotification]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notification-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
