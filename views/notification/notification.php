<?php

use app\helpers\Utils;
use app\models\Notification;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Notifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .link-item,.link-item:hover{
        color: black;
        text-decoration: none;
    }
    .list-group-item:hover{
        background-color: #f7f7f7 !important;
    }
</style>
<div class="notification-index">

    <div class="card card-body b-10">
        <h3>
            All Notification <li class="far fa-bell"></li> 
        </h3>
        <hr>
        <ul class="list-group">
            <?php foreach ($notif as $n) : ?>
                <?php $muted = $n['status'] == 1 ? 'text-muted' : ''; ?>
                <a class="link-item <?= $muted; ?>" href="<?= Url::to([$n['route']]); ?>">
                    <li class="list-group-item">
                        <i class="fas fa-<?= $n['icon']; ?>"> </i>&nbsp;&nbsp;<?= $n['text']; ?> - <span class="text-xs text-muted"><?= Utils::time_elapsed_string($n['created_at']); ?></span>
                    </li>
                </a>
            <?php endforeach ?>
        </ul>
        <div class="mt-4">
            <?= \yidas\widgets\Pagination::widget([
                'pagination' => $pagination,
            ]) ?>
        </div>
    </div>


</div>