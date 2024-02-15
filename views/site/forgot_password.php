<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use app\helpers\Utils;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Login';
?>
<style>
    /* .login-page {
        display: flex;
        align-items: center;
        height: 75vh;
    } */
</style>
<div class="site-login">
    <div style="" class="mx-auto card b-10">
        <div class="card-body">
            <p class=><b>Forgot Your Password?</b></p>
            <small class="mb-3">Don't worry! It happens to the best of us. Please enter your email address below, and we'll send you a link to reset your password.</small>
            <!-- <p class="">Please fill out the following fields to login:</p> -->
            <hr>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username'])->label(false) ?>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Your Email'])->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('<i class="fa-regular fa-envelope"></i> &nbsp;Submit', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            </div>
            <a class="text-center w-100 text-muted" href="<?= Url::to(['site/login',]); ?>">
                <li class="fa fa-chevron-left"></li> &nbsp;Back to Sign-in?
            </a>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>