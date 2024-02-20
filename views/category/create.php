<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\mstCategory $model */

$this->title = 'Create Mst Category';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mst-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
