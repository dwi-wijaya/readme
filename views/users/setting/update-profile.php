<?php

use yii\bootstrap4\Html;
use yii\widgets\ActiveForm;

$this->title = "Edit Profile ";
$this->params['breadcrumbs'][] = ['label' => 'Account', 'url' => ['account','id' => $model->username]];
$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['settings']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card card-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <div class="form-row">
        <div class="col">
            <?= $form->field($model, 'first_name')->textInput(['placeholder' => 'First Name']) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Last Name']) ?>
        </div>
    </div>


    <?= $form->field($model, 'bio')->textarea() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>