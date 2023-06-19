<?php

use app\helpers\Utils;
use yii\helpers\Url;
?>

<div class="tablist" id="nav-tab" role="">
    <a class="nav-item nav-link active" id="tab-bookmark" href="#" aria-selected="true">
        <li style="scale: 1.3;" class="fa-solid fa-bookmark"></li>
    </a>
    <a class="nav-item nav-link" id="tab-like" href="#" aria-selected="false">
        <li style="scale: 1.3;" class="fa-regular fa-heart"></li>
    </a>
</div>
<hr>
<div class=" show active" id="content-bookmark" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="row">
        <?php foreach ($bookmark as $t) : ?>
            <div class="col-12 col-md-4 col-lg-4 mt-4">
                <div class="article-card card card-body b-10">
                    <div class="card-img">
                        <a href="<?= Url::to(['/article/detail', 'id' => $t['slug']]); ?>">
                            <img class="thumbnail b-10 w-100" src="<?= Utils::baseUploadsthumbnail($t['thumbnail']); ?>" alt="" class="b-10">
                        </a>
                    </div>
                    <div class="title mt-3">
                        <a href="<?= Url::to(['/article/detail', 'id' => $t['slug']]); ?>">
                            <h4 class="m-0 card-title"><b><?= $t['title']; ?></b></h4>
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
<div style="display: none;" class="" id="content-like" role="tabpanel" aria-labelledby="nav-liked-tab">
    <div class="row">
        <?php foreach ($liked as $t) : ?>
            <div class="col-12 col-md-4 col-lg-3 mt-4">
                <div class="article-card card card-body b-10">
                    <div class="card-img">
                        <a href="<?= Url::to(['/article/detail', 'id' => $t['slug']]); ?>">
                            <img class="thumbnail b-10 w-100" src="<?= Utils::baseUploadsthumbnail($t['thumbnail']); ?>" alt="" class="b-10">
                        </a>
                    </div>
                    <div class="title mt-3">
                        <a href="<?= Url::to(['/article/detail', 'id' => $t['slug']]); ?>">
                            <h4 class="m-0 card-title"><b><?= $t['title']; ?></b></h4>
                        </a>
                        <p class="text-muted card-subtitle">
                            <?= ($t['subtitle']); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>