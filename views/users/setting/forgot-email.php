<?php

use app\helpers\Utils;
use richardfan\widget\JSRegister;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = "Reset Password";
$this->params['breadcrumbs'][] = ['label' => 'Account', 'url' => ['account', 'id' => $model->username]];
$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['settings']];
$this->params['breadcrumbs'][] = 'Reset Password';
?>
<div class="card card-body">

    <?php $form = ActiveForm::begin(['id' => 'forgot-password']); ?>
    <h3>Oops, Forgot Email Address?</h3>
    <p>
        We will send the the new email address verification to your email.
        Stay calm, we are here to help.</p>

    <?= $form->field($model, 'newEmail')->textInput(['placeholder' => 'Please type yout new email'])->label(false) ?>

    <?= Html::submitButton('<i class="fa-regular fa-envelope"></i> Send', ['class' => 'btn btn-outline-success btn-send']) ?>
    <?php ActiveForm::end(); ?>
</div>