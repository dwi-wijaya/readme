<?php

use app\helpers\Utils;
use app\models\mstCategory;
use app\models\User;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use kartik\select2\Select2;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Article $model */
/** @var yii\widgets\ActiveForm $form */
$model->article_tag = explode(', ', $model->tag);
$status = [
    1 => 'DONE',
    0 => 'DRAFT'
];
if ($model->status == Utils::STAT_REVISION) {
    $alr = 'alert-warning';
} elseif ($model->status == Utils::STAT_REJECT) {
    $alr = 'alert-danger';
}
$alertstat = [
    Utils::STAT_REJECT,
    Utils::STAT_REVISION
];

User::me()->role == 1 ? $toolbar = ['toolbar' => [
    ['Styles', '-',]
]] : null;
User::me()->role == 2 || User::me()->role == 0 ? $toolbar = ['extraPlugins' => 'colorbutton,colordialog,iframe,justify'] : null;

?>
<style>
    #editor {
        height: 400px !important;
    }

    .mb-0>a {
        display: block;
        position: relative;
    }

    .mb-0>a:after {
        content: "\f078";
        /* fa-chevron-down */
        font-family: 'FontAwesome';
        position: absolute;
        right: 0;
    }

    .mb-0>a[aria-expanded="true"]:after {
        content: "\f077";
        /* fa-chevron-up */
    }
</style>

<div class="article-form">
    <div class="card card-body b-10">
        <?php if (in_array($model->status, $alertstat)) : ?>
            <div class="alert <?= $alr; ?>" role="alert">
                <i class="fa-solid fa-circle-info"></i>&nbsp; <?= Html::encode($approval->reason->reason); ?>
                <br>
                <li class="fa-regular fa-sticky-note"></li>&nbsp; Note :
                 <?= $approval->note; ?>
            </div>
        <?php endif ?>

        <!-- <h1 class="text-center"><?= Html::encode($this->title) ?></h1> -->
        <hr class="py-2">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


        <?= $form->field($model, 'title')->textInput(['id' => 'title']) ?>

        <?= $form->field($model, 'subtitle')->textInput() ?>

        <?= $form->field($model, 'article_tag')->widget(Select2::classname(), [
            'data' => $tag,
            'options' => ['placeholder' => 'Select Tag . . .'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true
            ],
        ])->label('Tag'); ?>


        <?php echo
        $form->field($model, 'content')->widget(alexantr\ckeditor\CKEditor::class, [
            'clientOptions' => [
                // 'readOnly' => true,
                $toolbar
            ]
        ]);
        ?>

        <?= $form->field($model, 'idcat')->widget(Select2::classname(), [
            'data' => mstCategory::getList(),
            'options' => ['placeholder' => 'Select . . . '],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <?= $form->field($model, 'slug')->textInput(['id' => 'slug']) ?>

        <?= $form->field($model, 'status')->widget(Select2::classname(), [
            'data' => $status,
            'options' => ['placeholder' => 'Select . . . '],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <?php
        $form->field($model, 'file[]')->widget(FileInput::class, [
            'name' => 'file',
            'pluginOptions' => [
                'showPreview' => false,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false
            ]
        ]);
        ?>
        <?= $form->field($model, 'file')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
<?php JSRegister::begin() ?>
<script>
    var slug = function(str) {
        var $slug = '';
        var trimmed = $.trim(str);
        $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
        replace(/-+/g, '-').
        replace(/^-|-$/g, '');
        return $slug.toLowerCase();
    }

    $('#title').keyup(function() {
        $('#slug').val(slug($('#title').val()));
    })
</script>
<?php JSRegister::end() ?>