<?php

use app\helpers\Utils;
use yii\helpers\Url;
?>
<div class="col-6 col-md-4 col-lg-4 mb-4">
    <div class="article-card card card-body b-10">
        <div class="card-img">
            <img class="thumbnail b-10 w-100" src="<?= Utils::baseUploadsthumbnail($article['thumbnail']); ?>" alt="" class="b-10">
        </div>
        <div class="title mt-3">
            <a href="<?= Url::to(['/article/detail', 'id' => $article['slug']]); ?>">
                <p class="m-0"><b><?= $article['title']; ?></b></p>
            </a>
            <small class="text-muted sub-title">
                <?= $article['subtitle'] ?>
            </small>
        </div>
    </div>
</div>