<?php

/** @var yii\web\View $this */

use app\helpers\Utils;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->registerCssFile('@web/css/pages/guide.css');
$this->title = 'Readme';
?>
<style>

</style>
<div class="site-index">
    <div class="d-flex mb-3">
        <i  class="fa fa-fire title-icon"></i>&nbsp;
        <div>
            <h5 class="mb-0">
                Discover the Most Popular Guides
            </h5>
            <small>Explore Our Top-Rated Guides Loved by Thousands</small>
        </div>
    </div>
    <div class="row">

        <?php if ($popular) : ?>
            <?php foreach ($popular as $guide) {
                echo $this->render('_guide', ['guide' => $guide]);
            } ?>

        <?php else : ?>
            <p>No articles available at the moment. Please check back later.</p>
        <?php endif ?>
    </div>
    <hr>
    <div class="d-flex mb-3">
        <i class="fa fa-search title-icon"></i>&nbsp;
        <div>
            <h5 class="mb-0">
                Explore our Guide Directory
            </h5>
            <small>Your Comprehensive Resource for Expert Guidance</small>
        </div>
    </div>
    <div class="list-guide mt-4">
        <div class="row">
            <?php if ($guides) : ?>
                <?php foreach ($guides as $guide) {
                    echo $this->render('_guide', ['guide' => $guide]);
                } ?>

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