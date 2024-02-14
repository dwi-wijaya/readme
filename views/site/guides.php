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
    <div class="my-2">
        <h5 class="mb-0">
            <i class="fa fa-fire title-icon"></i>&nbsp;
            Discover the Most Popular Guides
        </h5>
        <small>Explore Our Top-Rated Guides Loved by Thousands</small>
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
    <div class="my-2 mt-5">
        <h5 class="mb-0">
            <i class="fa fa-book title-icon"></i>&nbsp;
            Explore our Guide Directory
        </h5>
        <small>Your Comprehensive Resource for Expert Guidance</small>
    </div>
    <div class="list-guide">
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