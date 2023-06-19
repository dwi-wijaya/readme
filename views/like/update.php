<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Like $model */

$this->title = 'Update Like: ' . $model->idlike;
$this->params['breadcrumbs'][] = ['label' => 'Likes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idlike, 'url' => ['view', 'idlike' => $model->idlike]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="like-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
