<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Guides $model */

$this->title = 'Update Guides: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Guides', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'idguide' => $model->idguide]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="guides-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
