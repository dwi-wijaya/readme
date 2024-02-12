<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use app\helpers\Utils;
use app\widgets\Alert;
use richardfan\widget\JSRegister;
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
            <div class="input-group mb-3">
                <?= Html::activeTextInput($model, 'otp', ['class' => 'form-control', 'placeholder' => 'Enter your OTP']) ?>
                <div class="input-group-append">
                    <?= Html::button('<i class="fa-regular fa-envelope"></i> Resend Code', ['class' => 'btn btn-outline-secondary', 'onclick' => 'resendOtp()']) ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Confirm', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            </div>
            <a class="text-center w-100" href="<?= Url::to(['site/forgot-password',]); ?>">
                <li class="fa fa-chevron-left"></li> &nbsp;Back to forget password?
            </a>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<script>
    function resendOtp() {
        $.ajax({
            type: 'POST',
            url: '<?= Url::to(['resend-otp', 'userId' => $userId, 'userEmail' => $userEmail]) ?>',
            success: function(response) {
                // Tampilkan pesan sukses atau lakukan tindakan yang sesuai
                // alert('OTP has been resent to your email.');
            },
            error: function(xhr, status, error) {
                // Tampilkan pesan error atau lakukan tindakan yang sesuai
                // alert('Failed to resend OTP.');
            }
        });
    }
</script>
