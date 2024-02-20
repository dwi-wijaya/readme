<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\mstReason $model */

$this->title = 'Update Mst Reason: ' . $model->idreason;
$this->params['breadcrumbs'][] = ['label' => 'Reasons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idreason, 'url' => ['view', 'idreason' => $model->idreason]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mst-reason-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
