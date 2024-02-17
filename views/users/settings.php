<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use app\models\User;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Setting';
$this->params['breadcrumbs'][] = ['label' => 'Account', 'url' => ['account', 'id' => User::me()->username]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <ul class="list-group">
        <a href="<?= Url::to(['profile']) ?>" class="list-group-item text-reset text-muted">
            <li class="mr-2 fa-solid fa-user-circle"></li> Profile
        </a>
        <a href="<?= Url::to(['reset-password']) ?>" class="list-group-item text-reset text-muted">
            <li class="mr-2 fa-solid fa-unlock"></li> Reset Password
        </a>
        <a href="<?= Url::to(['forgot-password']) ?>" class="list-group-item text-reset text-muted">
            <li class="mr-2 fa-solid fa-key"></li> Forgot Password
        </a>
        <a href="<?= Url::to(['forgot-email']) ?>" class="list-group-item text-reset text-muted">
            <li class="mr-2 fa-solid fa-envelope"></li> Forgot Email
        </a>
        <?= Html::a(
            '<i class="mr-2 fas fa-sign-out-alt"></i> Logout',
            ['/site/logout'],
            ['data' => ['confirm' => 'Are you sure you want to sign out ?', 'method' => 'post'], 'class' => 'list-group-item text-reset text-muted']
        ) ?>


    </ul>
</div>