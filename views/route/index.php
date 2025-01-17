<?php

use app\models\mstMenu;
use mdm\admin\AnimateAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $routes [] */

$this->title = 'Routes';
$this->params['breadcrumbs'][] = $this->title;

AnimateAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
    'routes' => $routes,
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';

?>
<style>
select option:checked {
    background-color: #f0f0f0; /* Ganti dengan warna latar belakang yang diinginkan */
}
</style>
<h2>Routes</h2>
<div class="card">
    <div class="card-header">

        <div class="row">
            <div class="col-sm-12">
                <div class="input-group">
                    <input id="inp-route" type="text" class="form-control" placeholder="<?= 'New route(s)'; ?>">
                    <span class="input-group-btn">
                        <?= Html::a('Add' . $animateIcon, ['create'], [
                            'class' => 'btn btn-success',
                            'id' => 'btn-new',
                        ]); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <div class="input-group">
                    <input class="form-control search" data-target="available" placeholder="<?= 'Search for available'; ?>">
                    <span class="input-group-btn">
                        <?= Html::a('<i class="fa-solid fa-arrows-rotate"></i>', ['refresh'], [
                            'class' => 'btn btn-default',
                            'id' => 'btn-refresh',
                        ]); ?>
                    </span>
                </div>
                <select multiple size="20" class="form-control list" data-target="available"></select>
            </div>
            <div class="col-sm-2 text-center">
                <br><br>
                <?= Html::a('&gt;&gt;' . $animateIcon, ['assign'], [
                    'class' => 'btn btn-success btn-assign',
                    'data-target' => 'available',
                    'title' => 'Assign',
                ]); ?><br><br>
                <?= Html::a('&lt;&lt;' . $animateIcon, ['remove'], [
                    'class' => 'btn btn-danger btn-assign',
                    'data-target' => 'assigned',
                    'title' => 'Remove',
                ]); ?>
            </div>
            <div class="col-sm-5">
                <input class="form-control search" data-target="assigned" placeholder="<?= 'Search for assigned'; ?>">
                <select multiple size="20" class="form-control list" data-target="assigned"></select>
            </div>
        </div>
    </div>
</div>