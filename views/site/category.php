<?php

/** @var yii\web\View $this */

use app\helpers\Utils;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = $catname ? $catname : 'Kategori';
$this->params['breadcrumbs'][] = ['label' => 'Category', 'url' => ['category']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .col form {
        display: flex;
        float: right;
    }
</style>
<div class="site-about">
    <?php if ($article) : ?>
        <div class="row mt-5">
            <div class="col-1">
                <hr>
            </div>
            <div class="col">
                <p class="text-muted m-0">There's <b><?= ($total)  ?></b> article in this category .</p>
            </div>
        </div>
        <div class="article mt-4">

            <div class="row">
                <?php if ($article) : ?>
                    <?php foreach ($article as $t) : ?>
                        <?= $this->render('_aticle', ['article' => $t]) ?>
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
    <?php else : ?>
        <div class="row mt-5">
            <div class="col-1">
                <hr>
            </div>
            <div class="col">
                <h6 class="text-muted m-0">All Categories.</h6>
            </div>
        </div>

        <div class="category mt-4">

            <div class="row">
                <?php foreach ($cat as $c) : ?>
                    <div class="col-12 col-md-4 col-lg-3 mt-4">
                        <a href="<?= Url::to(['site/category', 'cat' => $c['idcat']]); ?>">
                            <div class="category-card card card-body b-10">
                                <div class="category-title">
                                    <div class="d-row">
                                        <?= Utils::fa($c['icon'], $c['color']); ?>
                                        <p class="ml-2 mb-0 total-badge border badge badge-light"><?= $c['total'] + 0 ;?></p>
                                    </div>
                                    <h6 class="pt-2 mt-2 m-0"><?= $c['name']; ?></h6>
                                </div>
                                <p class="mt-2 text-muted cat-desc"><?= $c['description']; ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    <?php endif ?>
</div>