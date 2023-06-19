<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Article $model */

$this->title = 'Create Article';
?>
<div class="article-create">


    <?= $this->render('_form', [
        'model' => $model,
        'myasset' => $myasset,
        'asset' => $asset,
        'tag' => $tag,
        'cat' => $cat
    ]) ?>

</div>