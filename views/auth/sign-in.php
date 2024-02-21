<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use app\helpers\Utils;
use app\widgets\Alert;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Sign-in';
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

        <div class="card-header">

            <img class="d-flex mx-auto" src="<?= Utils::baseUploadsStock('article.png'); ?>" width="50%" alt="">
            <h1 class="fw-700 text-center mt-3 mb-0">Welcome Back!</h1>
            <p class="m-0 text-center">Let's get started by signing in.</p>
        </div>
        <div class="card-body">
            <!-- <p class="">Please fill out the following fields to login:</p> -->
            <?= Alert::widget() ?>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',

            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username'])->label(false) ?>

            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
            <div class="form-group">
                <?= Html::submitButton('<i class="fa-solid fa-right-to-bracket"></i>&nbsp; Sign-in', ['class' => 'btn btn-block btn-login', 'name' => 'login-button']) ?>
            </div>
            <p class="mb-0">
                Dont have account yet ? <a href="<?= Url::to(['sign-up',]); ?>"><b>Sign-up</b></a>
            </p>
            <a href="<?= Url::to('forgot-password') ?>">
                <p>Forgot passowrd ?</p>
            </a>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>