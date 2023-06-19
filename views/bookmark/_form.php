<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Bookmark $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="bookmark-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idbookmark')->textInput() ?>

    <?= $form->field($model, 'idarticle')->textInput() ?>

    <?= $form->field($model, 'iduser')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
