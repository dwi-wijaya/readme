<?php
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;
?>
<div class="content-wrapper position-relative">
<style>
        .bg-wrapper {
            position: absolute;
            height: 20vh;
            background: #f17f46;
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
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <?php
                    echo Breadcrumbs::widget([
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
    <div class="content px-3 position-relative" style="z-index: 1;">
        <?= \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true]); ?>
        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>