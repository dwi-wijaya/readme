<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\mstMenu $model */

$this->title = 'Create Mst Menu';
$this->params['breadcrumbs'][] = ['label' => 'Mst Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
