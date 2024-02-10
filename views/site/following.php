<?php

/** @var yii\web\View $this */

use app\helpers\Utils;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Readme';
?>
<style>

</style>
<div class="site-index">

    <div class="row mt-5">
        <div class="col-1">
            <hr>
        </div>
        <div class="col">
            <h5>Following author</h5>
        </div>
    </div>
    <div class="most-viewed mt-4">
        <div class="row">
            <?php if ($following) : ?>
                <?php foreach ($following as $t) : ?>
                    <?= $this->render('_article', ['article' => $t]) ?>
                <?php endforeach ?>
            <?php else : ?>
                <p>No articles available at the moment. Please check back later.</p>
            <?php endif ?>
        </div>

        <div class="mt-4">
            <?= \yidas\widgets\Pagination::widget([
                'pagination' => $pagination
            ]) ?>
        </div>
    </div>
</div>