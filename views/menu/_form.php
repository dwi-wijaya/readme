<?php

use app\models\mstMenu;
use app\models\Route;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\mstMenu $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card card-body">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col">
            <?= $form->field($model, 'name')->textInput() ?>

        </div>
        <div class="col">
            <?= $form->field($model, 'is_dropdown')->widget(Select2::classname(), [
                'data' => mstMenu::getMenutype(),
                'options' => ['placeholder' => 'Select a menu ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
    </div>

    <?= $form->field($model, 'route')->widget(Select2::classname(), [
        'data' => Route::getRoutes(true),
        'options' => ['placeholder' => 'Select a route ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?= $form->field($model, 'parent')->widget(Select2::classname(), [
        'data' => mstMenu::getParentMenu(true),
        'options' => ['placeholder' => 'Select a parent ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'order')->textInput() ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'icon')->textInput() ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'type')->widget(Select2::classname(), [
                'data' => mstMenu::getList(),
                'options' => ['placeholder' => 'Select a type ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>