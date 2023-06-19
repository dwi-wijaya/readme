<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Approval $model */

$this->title = 'Update Approval: ' . $model->idapproval;
$this->params['breadcrumbs'][] = ['label' => 'Approvals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idapproval, 'url' => ['view', 'idapproval' => $model->idapproval]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="approval-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
