<?php

use app\helpers\Utils;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>


<div class="row mt-5">
            <div class="col-1">
                <hr>
            </div>
            <div class="col">
                <h4>Latest Article</h4>
            </div>
            <div class="col">
                <?php $form = ActiveForm::begin([
                    'action' => ['account'],
                    'method' => 'GET',
                    'options' => [
                        'data-pjax' => 1,
                    ],
                ]); ?>

                <?php $form->field($articlemodel, 'search')->textInput()->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton('<li class="fa fa-search"></li>', ['class' => 'btn btn-success ml-2']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="latest">
            <?php foreach ($latest as $l) : ?>
                <div class="col-12 col-md-4 col-lg-3 mt-4">
                    <div class="article-card card card-body b-10">
                        <div class="card-img">
                            <a href="<?= Url::to(['/article/detail', 'id' => $l['idarticle']]); ?>">

                                <img class="thumbnail b-10 w-100" src="<?= Utils::baseUploadsthumbnail($l['thumbnail']); ?>" alt="" class="b-10">
                            </a>
                        </div>
                        <div class="title mt-3">
                            <a href="<?= Url::to(['/article/detail', 'id' => $l['idarticle']]); ?>">
                                <h4 class="m-0 card-title"><b><?= $l['title']; ?></b> <span class="created_at text-muted">/ <?= Yii::$app->formatter->asDate($l['created_at']) ?></span></h4>
                            </a>
                            <p class="text-muted card-subtitle">
                                <?= $l['subtitle']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>


        <div class="row mt-5">
            <div class="col-1">
                <hr>
            </div>
            <div class="col">
                <h4>Top Article</h4>
            </div>
        </div>

        <div class="row">
            <?php foreach ($top as $t) : ?>
                <div class="col-12 col-md-4 col-lg-3 mt-4">
                    <div class="article-card card card-body b-10">
                        <div class="card-img">
                            <a href="<?= Url::to(['/article/detail', 'id' => $t['slug']]); ?>">
                                <img class="thumbnail b-10 w-100" src="<?= Utils::baseUploadsthumbnail($t['thumbnail']); ?>" alt="" class="b-10">
                            </a>
                        </div>
                        <div class="title mt-3">
                            <a href="<?= Url::to(['/article/detail', 'id' => $t['slug']]); ?>">
                                <h4 class="m-0 card-title"><b><?= $t['title']; ?></b> <span class="created_at text-muted">/ <?= $t['total'] ?>x view</span></h4>
                            </a>
                            <p class="text-muted card-subtitle">
                                <?= $t['subtitle']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>