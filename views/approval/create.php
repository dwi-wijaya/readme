<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Approval $model */

$this->title = 'Create Approval';
$this->params['breadcrumbs'][] = ['label' => 'Approvals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approval-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
