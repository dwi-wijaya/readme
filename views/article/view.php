<?php

use app\helpers\Utils;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Article $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="article-view">
    <div class="card card-body b-10">
        <h1 class="m-0"><?= Html::encode($this->title) ?></h1>
        <hr>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->idarticle], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Utils::fa('search'), ['detail', 'id' => $model->idarticle], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->idarticle], [
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
                'title',
                'subtitle',
                'created_at',
                'tag',
                'content:ntext',
                'author_id',
                'thumbnail',
                'cetegory',
                'updated_at',
                'status',
                'slug',
                'editor_id',
                'approved_at',
            ],
        ]) ?>
    </div>

</div>