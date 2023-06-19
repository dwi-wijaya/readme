<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Bookmark $model */

$this->title = 'Update Bookmark: ' . $model->idbookmark;
$this->params['breadcrumbs'][] = ['label' => 'Bookmarks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idbookmark, 'url' => ['view', 'idbookmark' => $model->idbookmark]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bookmark-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
