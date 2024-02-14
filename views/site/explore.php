<?php

/** @var yii\web\View $this */

use app\helpers\Utils;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$options = ['class' => 'filter-category mr-2'];

if ($idcat) {
    Html::removeCssClass($options, 'btn-default');
    Html::addCssClass($options, 'btn-success');
}
$this->title = "Explore";
?>
<style>
    .col form {
        display: flex;
        float: right;
    }

    .card-title {
        font-size: 1.25rem !important;
    }

    .card-subtitle {
        margin-top: .3rem;
        font-size: .75rem !important;
    }
</style>
<div class="site-about">
    <div class="my-2">
        <h5 class="mb-0">
            <i class="fa fa-layer-group title-icon"></i>&nbsp;
            Navigate Through Our Article Categories
        </h5>
        <small>Find Articles Organized by Topic for Easy Browsing</small>
    </div>
    <div class="category my-2">
        <div class="row">
            <?php foreach ($cat as $c) : ?>
                <div class="col-12 col-md-4 col-lg-3 p-2">
                    <a href="<?= Url::to(['site/category', 'idcat' => $c['idcat']]); ?>">
                        <div class="category-card card card-body b-10">
                            <div class="category-title">
                                <?= Utils::fa($c['icon'], $c['color']); ?>
                                <h6 class="pt-2 mt-2 m-0"><?= $c['name']; ?></h6>
                            </div>
                            <p class="mt-2 text-muted cat-desc"><?= $c['description']; ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="row mt-5 mb-2">
        <div class="col">
            <h5 class="mb-0">
                <i class="fa fa-binoculars  title-icon"></i>&nbsp;
                Embark on a Journey of Discovery
            </h5>
            <small>Explore a Wide Range of Topics in Our Vast Article Collection</small>
        </div>
        <div class="col">
            <?php $form = ActiveForm::begin([
                'action' => ['explore'],
                'method' => 'GET',
                'options' => [
                    'data-pjax' => 1,
                ],
            ]); ?>

            <?= $form->field($model, 'search')->textInput()->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('<li class="fa fa-search"></li>', ['class' => 'btn btn-success ml-2']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="row ml-1">
        <?php foreach ($cat as $c) : ?>
            <a class="filter-category mr-2 badge badge-light border  p-2" href="<?= Url::to(['explore', 'idcat' => $c['idcat']]); ?>" data="<?= $c['idcat']; ?>">
                <?= $c['name']; ?>
            </a>
        <?php endforeach ?>
    </div>

    <div class="article mt-4">
        <?php if ($article == null) : ?>
            <p>Sorry, Searching for <b><?= $model->search; ?></b> not found !</p>
        <?php else : ?>
            <div id="filter-result" class="row">
                <?php if ($article) : ?>
                    <?php foreach ($article as $t) : ?>
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
        <?php endif ?>
    </div>
</div>
<?php JSRegister::begin() ?>
<script>
    $(document).ready(function() {
        var idcat = '<?= $idcat; ?>';
        $('[data=' + idcat + ']').removeClass("badge-light");
        $('[data=' + idcat + ']').addClass("badge-secondary");
    })
</script>
<?php JSRegister::end() ?>