<?php

use app\models\Article;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Guides $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="guides-form">
    <div class="card card-body">

        <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'pretext')->textInput(['maxlength' => true])->label('Pretext &nbsp;<code>text before title article.</code>') ?>


        <?= $form->field($model, 'file')->widget(FileInput::class, [
            'name' => 'file',
            'pluginOptions' => [
                'showPreview' => false,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false
            ]
        ]); ?>
        <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows' => 3]) ?>

        
        <?= $form->field($model, 'level')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>