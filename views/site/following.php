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
            <?php foreach ($following as $t) : ?>
                <div class="col-6 col-md-4 col-lg-4 mb-4">
                    <div class="article-card card card-body b-10">
                        <div class="card-img">
                            <img class="thumbnail b-10 w-100" src="<?= Utils::baseUploadsthumbnail($t['thumbnail']); ?>" alt="" class="b-10">
                        </div>
                        <div class="title mt-3">
                            <a href="">
                                <p class="m-0"><b><?= $t['title']; ?></b></p>
                            </a>
                            <small class="text-muted sub-title">
                                <?= substr($t['subtitle'], 0, 100) . ' . . . . .'; ?>
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