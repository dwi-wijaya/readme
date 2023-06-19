<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Follow $model */

$this->title = 'Update Follow: ' . $model->idfollow;
$this->params['breadcrumbs'][] = ['label' => 'Follows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idfollow, 'url' => ['view', 'idfollow' => $model->idfollow]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="follow-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
