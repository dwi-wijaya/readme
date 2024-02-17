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

        <h2>Your Link Didn't Work</h2>
        <h6 class="mt-3">
            It appears that the link you've used is no longer valid or has already been used. We apologize for the inconvenience.
        </h6>

        <a class="btn btn-warning mt-5" href="<?= Url::to(['site/index']) ?>">Back to Homepage</a>

    </div>

</div>