<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Assets $model */

$this->title = 'Update Assets: ' . $model->idasset;
$this->params['breadcrumbs'][] = ['label' => 'Assets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idasset, 'url' => ['view', 'idasset' => $model->idasset]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assets-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
