<?php

use app\helpers\Utils;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Sign-up';
?>
<div class="site-login">
    <div style="width: 35rem;" class="mx-auto card b-10">

        <div class="card-header">

            <img class="d-flex mx-auto" src="<?= Utils::baseUploadsStock('article.png'); ?>" width="50%" alt="">
            <h1 class="fw-700 text-center mt-3">Sign-up !!</h1>
        </div>
        <div class="card-body">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',

            ]); ?>

            <hr>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'first_name')->textInput() ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'last_name')->textInput() ?>
                </div>
            </div>
            <?= $form->field($model, 'username')->textInput() ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <p>
                already have account ? <a href="<?= Url::to(['/site/login',]); ?>"><b>Log-in</b> </a>
            </p>

            <div class="form-group">
                <div class="">

                    <?= Html::submitButton('<i class="fa-solid fa-right-to-bracket"></i> &nbsp;Sign-up', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

                </div>
                <br>

            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>