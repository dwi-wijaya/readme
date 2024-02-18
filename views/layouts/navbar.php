<?php

use app\helpers\Utils;
use app\models\mstMenu;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

$menu = mstMenu::getNativenavbar();
?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light bg-main">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item ">
            <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <?php foreach ($menu as $m) : ?>
            <li class="nav-item active ">
                <a class="nav-link p-2 text-white" href="<?= Url::to([$m['route']]) ?>">
                    <span class="fa fa-<?= $m['icon'] ?>"></span> &nbsp; <?= $m['name']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto align-items-center">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link text-white" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span style="background-color: #0751ff;" class="badge text-white navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        
        <li class="nav-item text-white">
            <?= Html::a('<i class="fas fa-sign-out-alt text-white"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>
        <li class="nav-item text-white">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt text-white"></i>
            </a>
        </li>
        <li class="nav-item text-white mr-2">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large text-white"></i>
            </a>
        </li>
        <li class="nav-item text-white">
            <div class="btn-group d-none d-lg-block d-md-block" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-main btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= User::me()->first_name . ' / ' . Utils::getLabelRolename() ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <?= Html::a(User::me()->first_name . ' ' . User::me()->last_name, Url::to(['users/account', 'id' => User::me()->username]), ['class' => 'nav-link nav-user']) ?>
                    <div class="dropdown-divider"></div>
                    <?= Html::a('<i class="fas fa-sign-out-alt"></i> Logout', ['/site/logout'], ['data' => ['confirm' => 'Are you sure you want to sign out ?', 'method' => 'post'], 'class' => 'nav-link nav-user']) ?>
                </div>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->