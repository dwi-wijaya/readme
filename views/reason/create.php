<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\mstReason $model */

$this->title = 'Create Mst Reason';
$this->params['breadcrumbs'][] = ['label' => 'Reasons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-reason-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
