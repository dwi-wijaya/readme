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

    <div class="card card-body">
        <div class="d-flex mb-3 gap-3 detail-guide" style="gap: 1rem;">
            <img width="150" style="border-radius: 5px;" src="<?= Url::base(true) . '/uploads/guides-thumbnail/' . $guides->thumbnail  ?>" alt="" srcset="">
            <div class="">
                <h1 class="fw-700"><?= $guides->title ?></h1>
                <p class="text-muted">
                    <?= $guides->description ?>
                </p>
                <small class="text-muted">
                    <li class="fa-regular fa-clock text-muted"></li> &nbsp;<?= $guides->created_at ?>
                    &nbsp; | &nbsp;
                    <li class="fa-regular fa-user text-muted"></li> &nbsp; <a class="text-muted" href="<?= Url::to(['user/account']) ?>"><?= $guides->author ?></a>
                </small>
            </div>

        </div>
        <hr class="my-0">
        <div class="most-viewed mt-4">
            <?php if ($guides->list && is_array($guides->list)) : ?>
                <ol class="pl-0">
                    <?php foreach ($guides->list as $article) : ?>
                        <li class="card card-body card-guide-list">
                            <a href="<?= Url::to(['article/detail', 'id' => $article->article->slug]) ?>" class="d-flex align-items-center">
                                <i class="fa-regular fa-file-lines" style="margin-right: 5px;"></i> &nbsp;
                                <span> <?= $guides->pretext . ' ' . $article->order . ' : ' . $article->article->title ?></span>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ol>

            <?php else : ?>
                <p>No articles available at the moment. Please check back later.</p>
            <?php endif ?>

        </div>
    </div>
</div>