<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use app\helpers\Utils;
use app\widgets\Alert;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Confirm Email';
?>

<div class="site-login text-center">
    <div class="card card-body p-4">

        <h1>You're All Set</h2>
            <h6 class="mt-3">
                You have successfully verified your email address.
                To make more changes, please visit Account Settings.
            </h6>

            <a class="btn btn-warning mt-5" href="<?= Url::to(['users/account', 'id' => $user->username]) ?>">Account Setting</a>
    </div>

</div>