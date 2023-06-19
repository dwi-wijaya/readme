<?php

use yii\helpers\Html;

$this->title = 'Dashboard';
?>
    <h1><?= Html::encode($this->title); ?></h1>
    <hr>
    <div class="row">
        <div class="col-4">
            <div class="card card-info card-outline card-body b-10">
                <h1 class="text-center">80</h1>
                <p class="text-center">
                    Author
                </p>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-warning card-outline card-body b-10">
                <h1 class="text-center">32</h1>
                <p class="text-center">
                    Editor
                </p>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-success card-outline card-body b-10">
                <h1 class="text-center">144</h1>
                <p class="text-center">
                    Subscriber
                </p>
            </div>
        </div>
    </div>