<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Approval $model */

$this->title = $model->idapproval;
$this->params['breadcrumbs'][] = ['label' => 'Approvals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="approval-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idapproval' => $model->idapproval], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idapproval' => $model->idapproval], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idapproval',
            'idarticle',
            'status',
            'approved_date',
            'note:ntext',
        ],
    ]) ?>

</div>
