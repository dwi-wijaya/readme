<?php

use app\helpers\AuthHelpers;
use app\helpers\MenuHelpers;
use app\helpers\RoleHelpers;
use app\helpers\Url as Url2;
use app\helpers\Utils;
use app\models\Notification;
use app\models\User;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<style>
    nav.main-header {
        z-index: 100 !important;
        margin-left: 0 !important;
        width: 100% !important;
        border-bottom: 1px solid #bbb;
        align-items: center;
    }

    .sidebar-mini.sidebar-collapse .main-header {
        margin-left: 0px !important;
        padding-right: 20px !important;
    }

    .nav-brand {
        color: #565656;
    }

    .main-header .navbar-nav .nav-item {
        margin: 0;
        align-items: center;
        display: flex;
    }

    .notif-overflow {
        max-height: 20rem;
        overflow-x: auto;
    }

    .icon {
        display: flex;
        align-items: center;
        height: 100%;
        justify-content: center;
        margin: 0 !important;
    }

    .notif-item {
        font-size: 13px;
    }
</style>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link nav-toogle" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="d-flex gap-3" href="<?= Url::base(true) ?>/site">
                <i style="    font-size: 30px;color: #565656;" class="fa-regular fa-newspaper"></i>
                <h3 class="fw-700 m-0  nav-brand ml-1">Readme</h3>
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <?php if (Url::current() == '/article/create' || preg_match('/update\?id=\d+/', Url::current())) : ?>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        <?php endif ?>
        <li class="nav-item">
            <div class="btn-group d-none d-lg-block d-md-block" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= User::me()->first_name . ' / ' . Utils::getLabelRolename() ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <?= Html::a(User::me()->first_name . ' ' . User::me()->last_name, Url::to(['users/account', 'id' => User::me()->username]), ['class' => 'nav-link nav-user']) ?>
                    <div class="dropdown-divider"></div>
                    <?= Html::a('<i class="fas fa-sign-out-alt"></i> Logout', ['/site/logout'], ['data' => ['confirm' => 'Apakah anda yakin ingin keluar ?', 'method' => 'post'], 'class' => 'nav-link nav-user']) ?>
                </div>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
<?php JSRegister::begin() ?>
<script>
    // setInterval(function() {
    //     $.get("<?= Url::to(['module/notif']) ?>", function(data) {
    //         var data = JSON.parse(data);
    //         var total_notif = data.length;
    //         $(".notif-count").html(total_notif);
    //         $("#total").html(total_notif + ' Notification');
    //         let result = '';
    //         data.sort(function(a, b) {
    //             return new Date(b.created_at) - new Date(a.created_at);
    //         });
    //         console.log(data);
    //         data.forEach(function(item) {
    //             // var route = '<?= Url::base(true); ?>' + item.route;
    //             var route = '<?= Url::base(true); ?>' + 'notification/marknotif?id=' + item + idnotification + '?route=' + item.route + ;
    //             result += '<div class="dropdown-divider"></div>';
    //             result += '<a data="" style="white-space: normal;" href="' + route + '" class="notif-link dropdown-item">';
    //             result += '    <div class="row">';
    //             result += '        <div class="col-2">';
    //             result += '            <i class="icon fas fa-' + item.icon + ' mr-2"></i>';
    //             result += '        </div>';
    //             result += '        <div class="col notif-item">';
    //             result += '            <p>' + item.text + ' - <span class=" text-muted text-sm"></span>\</p>';
    //             result += '        </div>';
    //             result += '    </div>';
    //             result += '</a>';

    //             result += '<div class="dropdown-divider"></div>';
    //             result += '<a href="' + route + '" class="notif-link dropdown-item">';
    //             result += '<i class="icon fas fa-' + item.icon + ' mr-2"></i> ' + item.text + '';
    //             result += '<span class="float-right text-muted text-sm">12 hours</span>';
    //             result += '</a>';
    //         });
    //         $(".notif-overflow").html(result);
    //     });
    // }, 3000);
</script>
<?php JSRegister::end() ?>