<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Trending $model */

$this->title = 'Create Trending';
$this->params['breadcrumbs'][] = ['label' => 'Trendings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trending-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
