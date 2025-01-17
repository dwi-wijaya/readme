<?php
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;
?>
<div class="content-wrapper position-relative">
    <style>
        .bg-wrapper {
            display: none;
            position: absolute;
            height: 23vh;
            background: #4560c4 ;
            border-radius: 0 0 6px 6px;
            width: 100%;
            margin-top: calc(0px);
            /* Mengikuti margin parent */
            margin-left: calc(0px);
            /* Mengikuti margin parent */
        }
    </style>
    <div class="bg-wrapper"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header px-5">
        <div class="container-fluid ">
            <div class="row">

                <div class="col-sm-6 p-0">
                    <?php

                    echo Breadcrumbs::widget([
                        'homeLink' => [
                            'label' => Yii::t('yii', 'Dashboard'),
                            'url' => Yii::$app->homeUrl,
                        ],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => [
                            'class' => 'breadcrumb float-sm-left'
                        ]
                    ]);
                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content px-5 position-relative" style="z-index: 1;">
        <?= \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true]); ?>
        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>