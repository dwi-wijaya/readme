<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Guides $model */

$this->title = 'Create Guides';
$this->params['breadcrumbs'][] = ['label' => 'Guides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guides-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
