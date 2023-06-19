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
    <div style="width: 35rem;" class="mx-auto card b-10">

        <div class="card-header">

            <img class="d-flex mx-auto" src="<?= Utils::baseUploadsStock('article.png'); ?>" width="50%" alt="">
            <h1 class="fw-700 text-center mt-3">Welcome Back !!</h1>
        </div>
        <div class="card-body">
            <!-- <p class="">Please fill out the following fields to login:</p> -->

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',

            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>
            <p class="">
                Dont have account yet ? <a href="<?= Url::to(['site/signup',]); ?>"><b>Sign-up</b> </a>
            </p>
            <div class="form-group">
                <?= Html::submitButton('<i class="fa-solid fa-right-to-bracket"></i> &nbsp;Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>