<?php

use app\models\Article;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Guides $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="guides-form">

    <?php $form = ActiveForm::begin(['action' => Url::to('update-list', $id = $model->idguide_list)]); ?>

    <?= $form->field($model, 'idguide')->hiddenInput(['maxlength' => true])->label(false) ?>

    <div class="form-row">
        <div class="col-12 col-md-2">
            <?= $form->field($model, 'order')->textInput(['placeholder' => 'Order'])->label(false) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'idarticle')->widget(Select2::classname(), [
                'data' => Article::findArticlebyAuthor($authorId, true),
                'options' => ['placeholder' => 'Title . . . '],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false); ?>
        </div>
    </div>
    
    <div class="form-group float-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>