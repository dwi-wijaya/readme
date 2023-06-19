<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Assets $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="assets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idasset')->textInput() ?>

    <?= $form->field($model, 'asset_name')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'iduser')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
