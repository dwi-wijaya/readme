<?php

use app\helpers\Utils;
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
?>
<style>

</style>
<div class="article-form">
    <div class="card card-body b-10">

        <!-- <h1 class="text-center"><?= Html::encode($this->title) ?></h1> -->
        <hr class="py-2">

        <?php $form = ActiveForm::begin(['action' => ['/article/approval']]); ?>
        <div class="d-note">
            <?= $form->field($app, 'note')->widget(alexantr\ckeditor\CKEditor::className()) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
<?php JSRegister::begin() ?>
<script>

</script>
<?php JSRegister::end() ?>