<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\mstMenu $model */

$this->title = 'Update Mst Menu: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mst Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'idmenu' => $model->idmenu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mst-menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
