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
$sensoredEmail = Utils::sensorEmail($model->email);
?>
<div class="card card-body">

    <?php $form = ActiveForm::begin(['id' => 'forgot-password']); ?>
    <h3>Oops, Forgot Password?</h3>
    <p>
        We will send the password reset link to your email.
        Stay calm, we are here to help.</p>
    <div class="input-group mb-3">
        <?= Html::textInput('mail', $sensoredEmail, ['class' => 'form-control', 'disabled' => true]) ?>
        <div class="input-group-append">
            <?= Html::submitButton('<i class="fa-regular fa-envelope"></i> Send', ['class' => 'btn btn-outline-success btn-send']) ?>
        </div>
    </div>

    <a href="<?= Url::to(['forgot-email']) ?>" class="text-reset text-muted mb-3" style="text-decoration: underline;">
        <small>Forgot your email ?</small>
    </a>

    <?php ActiveForm::end(); ?>
</div>
