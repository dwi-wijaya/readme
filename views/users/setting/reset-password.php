<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = "Reset Password";
$this->params['breadcrumbs'][] = ['label' => 'Account', 'url' => ['account', 'id' => $model->username]];
$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['settings']];
$this->params['breadcrumbs'][] = 'Reset Password';
$model->password = null;
?>
<div class="card card-body">

    <?php $form = ActiveForm::begin(['id' => 'reset-password']); ?>

    <?= $form->field($model, 'currentPassword')->passwordInput(['placeholder' => 'Current Password'])->label(false) ?>
    <?= $form->field($model, 'newPassword')->passwordInput(['placeholder' => 'New Password'])->label(false) ?>
    <?= $form->field($model, 'confirmPassword')->passwordInput(['placeholder' => 'Confirm Password'])->label(false) ?>

    <a href="<?= Url::to(['forgot-password']) ?>" class="text-reset text-muted mb-3" style="text-decoration: underline;">
        <small>Forgot your password ?</small>
    </a>
    
    <div class="form-group mt-3">
        <?= Html::submitButton('Reset', ['class' => 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>
</div>