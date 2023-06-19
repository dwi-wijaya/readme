<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Setting';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">

    <?= Html::beginForm(['site/logout'], 'post', ['class' => 'form-inline'])
        . Html::submitButton(
            ' <i class="fa fa-solid fa-right-from-bracket"></i>  Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-danger text-center btn-sm logout shadow'],
        )
        . Html::endForm() ?>
</div>