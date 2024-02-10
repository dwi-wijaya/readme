<?php

use app\helpers\Utils;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Sign-up';
?>
<div class="site-login">
    <div style="" class="mx-auto card b-10">

        <div class="card-header">

            <img class="d-flex mx-auto" src="<?= Utils::baseUploadsStock('article.png'); ?>" width="50%" alt="">
            <h1 class="fw-700 text-center mt-3">Sign-up !!</h1>
            <p class="m-0 text-center">New here? Let's get started by creating your account.</p>
        </div>
        <div class="card-body">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',

    'enableClientValidation'=>true,

            ]); ?>

            <div class="form-row">
                <div class="col">
                    <?= $form->field($model, 'first_name')->textInput(['placeholder' => 'First Name'])->label(false) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Last Name'])->label(false) ?>
                </div>
            </div>
            <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username'])->label(false) ?>
            <?= $form->field($model, 'email')->textInput(['placeholder' => 'email'])->label(false) ?>

            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
            <?= $form->field($model, 'confirmPassword')->passwordInput(['placeholder' => 'Repeat Password'])->label(false) ?>

            <p>
                already have account ? <a href="<?= Url::to(['/site/login',]); ?>"><b>Sign-in</b> </a>
            </p>

            <div class="form-group">
                <?= Html::submitButton('<i class="fa-solid fa-right-to-bracket"></i> &nbsp;Sign-up', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>