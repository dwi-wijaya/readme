<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\mstTag $model */

$this->title = 'Update Mst Tag: ' . $model->idtag;
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtag, 'url' => ['view', 'idtag' => $model->idtag]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mst-tag-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
