<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $asset */

use app\helpers\Utils;
use kartik\file\FileInput;
use richardfan\widget\JSRegister;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;
use yii\helpers\Url;
// echo '<pre>';print_r($assets);die;
?>
<style>
    /* .upload {
        height: fit-content;
        right: 0;
        position: absolute;
        margin-right: 1.2rem;
    } */

    /* .site-asset form {
        display: flex;
        gap: 1.5rem;
        margin-top: 1rem;
    } */

    .site-asset form div {
        margin: 0 !important;
        height: fit-content !important;
    }

    .site-asset .mb-3 {
        margin-bottom: 0 !important;
    }

    .btnCopy {
        width: fit-content;
        margin: auto;
        white-space: nowrap;
        height: fit-content;
        padding: 5px;
        border-radius: 5px !important;
    }

    .btnDelete {
        width: fit-content;
        margin: auto;
        white-space: nowrap;
        height: fit-content;
        padding: 5px;
        border-radius: 5px !important;
    }

    .card {
        /* overflow: hidden; */
    }

    .card img {
        height: 12rem;
        object-fit: cover;
        transition: transform .5s ease;
    }

    .card img:hover {
        /* transform: scale(1.5); */
    }

    .copy {
        display: flex;
        margin-top: 1rem;
        gap: .5rem;
    }

    .img-assets {
        height: 75vh !important;
        overflow-y: auto;
    }

    .col-6 {
        height: fit-content;
    }

    .asset-form {
        margin-top: 4rem !important;

    }

    .asset-form input {
        background-color: transparent;
        color: white;
    }
</style>
<div class="site-asset">
    <div class="asset-form">

        <div class="search-form">
            <form id="filter-form">
                <div class="row">
                    <div class="col-11">
                        <input class="form-control" type="text" id="filter-value" name="filter-value" value="">
                    </div>
                    <div class="col-1">
                        <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>

        <div class="input-form mt-3">
            <?php $form = ActiveForm::begin(['action' => '/asset/create']); ?>
            <div class="row">
                <div class="col-11">
                    <?php
                    $form->field($model, 'file[]')->widget(FileInput::class, [
                        'name' => 'filedet',
                        'pluginOptions' => [
                            'showPreview' => false,
                            'showCaption' => true,
                            'showRemove' => true,
                            'showUpload' => false
                        ]
                    ]);
                    ?>
                    <?= $form->field($model, 'file')->fileInput()->label(false) ?>
                </div>
                <div class="col-1">

                    <div class="form-group">
                        <?= Html::submitButton('<i class="fa-solid fa-upload"></i>', ['class' => 'btn btn-outline-success upload', 'name' => 'contact-button']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>

    </div>
    <hr class="text-white">
    <?php if ($assets) : ?>
        <div id="filter-results" class="ml-1 row img-assets">
            <!-- <div > -->
            <!-- Results will be displayed here -->
            <!-- </div> -->

            <?php foreach ($assets as $a) : ?>
                <div class="def col-6">
                    <div class="asset-card card card-item card-body b-10">
                        <img class="b-10" src="<?= Utils::baseUploadsAssets($a['asset_name']) ?>" alt="" srcset="">
                        <div class="copy">
                            <input id="inputImgName" class="form-control" value="<?= Utils::baseUploadsAssets($a['asset_name']); ?>" type="text" placeholder="Default input" aria-label="default input example">
                            <?= Html::a('<i class="fas fa-trash"></i>', ['/asset/delete', 'id' => $a['idasset']], ['data' => ['confirm' => 'Are your sure to delete your asset ?', 'method' => 'post'], 'class' => 'btnDelete text-white btn btn-danger']) ?>
                            <button class="btn b-10 btn-secondary btnCopy">&nbsp;<i class="fa-solid fa-link"></i></button>

                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</div>
<?php JSRegister::begin() ?>
<script>
    $(function() {
        $('#filter-form').on('submit', function(e) {
            e.preventDefault(); // prevent the form from reloading the page
            var filterValue = $('#filter-value').val();
            $.ajax({
                url: '<?= Url::to(['asset/filter']) ?>',
                type: 'POST',
                data: {
                    filterValue: filterValue
                },
                success: function(data) {
                    // console.log(data);
                    var filteredData = JSON.parse(data);
                    var cardsHTML = '';
                    console.log(filteredData);
                    if (filteredData === null || filteredData.length === 0) {
                        cardsHTML += '<p style="margin: auto" class="text-white">Sorry, <b>' + filterValue + ' </b>Not Found !</p>';
                    } else {
                        // $('.def').hide();

                        for (var i = 0; i < filteredData.length; i++) {
                            var item = filteredData[i];
                            var imgUrl = "<?= Url::base(true); ?>/uploads/assets/" + item.asset_name;
                            var deleteUrl = "<?= Url::base(true); ?>/asset/delete?id=" + item.idasset;
                            // cardsHTML += '<div class="row">';
                            cardsHTML += '<div class="col-6">';
                                cardsHTML += '<div class="asset-card card card-item card-body b-10">';
                                    cardsHTML += '<img class="b-10" src="' + imgUrl + '" alt="" srcset="">';
                                        cardsHTML += '<div class="copy">';
                                            cardsHTML += '<input id="inputImgName" class="form-control" value="' + imgUrl + '" type="text" placeholder="Default input" aria-label="default input example">';
                                            cardsHTML += '<a class="btnDelete text-white btn btn-danger" href="' + deleteUrl + '" data-confirm="Are your sure to delete your asset ?" data-method="post"><i class="fas fa-trash"></i></a>'
                                            cardsHTML += '<button class="btn b-10 btn-secondary btnCopy">&nbsp;<i class="fa-solid fa-link"></i></button>';
                                    cardsHTML += '</div>';
                                cardsHTML += '</div>';
                            cardsHTML += '</div>';
                            // cardsHTML += '</div>';
                            
                        }
                    }
                    $('#filter-results').html(cardsHTML);
                }
            });
        });
    });

    $(".asset-card").each(function() {
        var card = $(this);
        var btnCopy = card.find(".btnCopy");
        var input = card.find("#inputImgName");

        btnCopy.click(function() {
            input.select();
            document.execCommand("copy");
            alert("Text copied to clipboard!");
        });
    });
</script>
<?php JSRegister::end() ?>