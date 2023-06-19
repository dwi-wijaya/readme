<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\mstCategory $model */

$this->title = 'Update Mst Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mst Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'idcat' => $model->idcat]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mst-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
