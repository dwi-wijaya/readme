<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Trending $model */

$this->title = 'Update Trending: ' . $model->idtrend;
$this->params['breadcrumbs'][] = ['label' => 'Trendings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtrend, 'url' => ['view', 'idtrend' => $model->idtrend]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trending-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
