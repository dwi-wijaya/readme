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
        <div class="my-2">
            <h5 class="mb-0">
                <i class="fa fa-fire title-icon"></i>&nbsp;
                Uncover Our Trending Articles
            </h5>
            <small>Dive into a Collection of Articles Trending Among Our Readers</small>
        </div>
        <div class="most-viewed mt-4">
            <div class="row">
                <?php if ($top) : ?>
                    <?php foreach ($top as $t) : ?>
                        <?= $this->render('_article', ['article' => $t]) ?>
                    <?php endforeach ?>
                <?php else : ?>
                    <p>No articles available at the moment. Please check back later.</p>
                <?php endif ?>
            </div>
        </div>
    <?php endif ?>

    <div class="my-2 mt-5">
        <h5 class="mb-0">
            <i class="fa fa-clock  title-icon"></i>&nbsp;
            Discover Our Latest Insights
        </h5>
        <small>Stay Updated with Our Newest Articles Freshly Published</small>
    </div>
    <div class="most-viewed mt-4">
        <div class="row">
            <?php if ($latest) : ?>
                <?php foreach ($latest as $t) : ?>
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