<?php

/** @var yii\web\View $this */

use app\helpers\Utils;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Readme';
$query_string = (isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null)
?>
<style>
    .home {
        display: block;
    }
</style>
<div class="site-index">
    <?php if ($query_string == strpos($query_string, 'page=1') || $query_string == NULL) : ?>
        <div class="row mt-5">
            <div class="col-1">
                <hr>
            </div>
            <div class="col">
                <h5>Most Viewed Article</h5>
            </div>
        </div>
        <div class="most-viewed mt-4">
            <div class="row">
                <?php foreach ($top as $t) : ?>
                    <div class="col-6 col-md-4 col-lg-4 mb-4">
                        <div class="article-card card card-body b-10">
                            <div class="card-img">
                                <img class="thumbnail b-10 w-100" src="<?= Utils::baseUploadsthumbnail($t['thumbnail']); ?>" alt="" class="b-10">
                            </div>
                            <div class="title mt-3">
                                <a href="<?= Url::to(['/article/detail', 'id' => $t['slug']]); ?>">
                                    <p class="m-0"><b><?= $t['title']; ?></b></p>
                                </a>
                                <small class="text-muted sub-title">
                                    <?= $t['subtitle'] ?>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    <?php endif ?>

    <div class="row mt-5">
        <div class="col-1">
            <hr>
        </div>
        <div class="col">
            <h5>Latest Article</h5>
        </div>
    </div>
    <div class="most-viewed mt-4">
        <div class="row">
            <?php foreach ($latest as $t) : ?>
                <div class="col-6 col-md-4 col-lg-4 mb-4">
                    <div class="article-card card card-body b-10">
                        <div class="card-img">
                            <a href="<?= Url::to(['/article/detail', 'id' => $t['slug']]); ?>">
                                <img class="thumbnail b-10 w-100" src="<?= Utils::baseUploadsthumbnail($t['thumbnail']); ?>" alt="" class="b-10">
                            </a>
                        </div>
                        <div class="title mt-3">
                            <a href="<?= Url::to(['/article/detail', 'id' => $t['slug']]); ?>">
                                <p class="m-0"><b><?= $t['title']; ?></b></p>
                            </a>
                            <small class="text-muted sub-title">
                                <?= $t['subtitle'] ?>
                            </small>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="mt-4">
            <?= \yidas\widgets\Pagination::widget([
                'pagination' => $pagination
            ]) ?>
        </div>
    </div>
</div>