<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use app\helpers\Utils;
use app\widgets\Alert;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Login';
?>

<div class="site-login">
    <div style="" class="mx-auto card b-10">
        <div class="card-body">
            <?= Alert::widget() ?>

            <p>Forgot Your Password?</p>
            <small class="mb-3">Don't worry! It happens to the best of us. Please enter your email address below, and we'll send you a link to reset your password.</small>
            <!-- <p class="">Please fill out the following fields to login:</p> -->
            <hr>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
            ]); ?>
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'New Password'])->label(false) ?>
            <?= $form->field($model, 'confirmPassword')->passwordInput(['placeholder' => 'Repeat Password'])->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('Reset', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            </div>
            <a class="text-center w-100" href="<?= Url::to(['site/forgot-password',]); ?>">
                <li class="fa fa-chevron-left"></li> &nbsp;Back to forget password?
            </a>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>