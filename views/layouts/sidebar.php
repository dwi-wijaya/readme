<?php

use app\helpers\Utils;
use app\models\mstMenu;
use app\models\User;
use mdm\admin\components\Helper;
use richardfan\widget\JSRegister;
use yii\helpers\Url;

?>
<style>
    aside {
        z-index: 50 !important;
        /* background-color: #2C74B3 !important; */
    }

    .main-sidebar .sidebar {
        margin-top: 4.1rem;
    }

    .sidebar .nav-link.active {
        background-color: #fff !important;
        box-shadow: none !important;
    }

    .sidebar a.nav-link.active {
        background-color: #fff !important;
        color: black !important;
    }

    .sidebar .nav-link p {
        white-space: nowrap;
    }

    .user-panel {
        background-color: #fff !important;
        border-radius: 5px;
    }

    .image img {
        border-radius: 10%;
    }

    .info a {
        color: black !important;
        font-weight: 300;
        letter-spacing: 2px;
    }

    .nav .nav-treeview {
        display: block;
        background-color: #4a535c !important;
        border-radius: 5px;
    }
    .nav-link:hover{
    }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-bold">Readme</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel pt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img style="" src="<?= Utils::baseUploadsProfile(User::me()->profile_picture); ?>" alt="" class="img-circle elevation-2">

            </div>
            <div class="info">
                <a href="<?= Url::to(['/users/account', 'id' => User::me()->username]); ?>" class="d-block"><?= User::me()->first_name . ' ' . User::me()->last_name; ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php

            
            $item = mstMenu::getNavbarLTE();
            // echo app\components\Nav::widget([

            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => $item,
                // 'options' => [
                //     'class' => 'nav nav-sidebar nav-legacy flex-column nav-compact', //'nav navbar-nav ml-auto nav-pills nav-sidebar flex-column nav-child-indent nav-legacy',
                //     'data-widget' => 'treeview',
                //     // 'role' => 'menu',
                //     'data-accordion' => false
                // ]
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php JSRegister::begin() ?>
<script>
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    $(document).ready(function() {
        $('.nav-item.has-treeview').find("ul").hide();
        // $('.nav-item.has-treeview').find("a").removeClass('active');
    })
    $('.nav-item.has-treeview').on('click', function(e) {
        // Prevent the default link behavior
        // e.preventDefault();
        // Check if the clicked menu item already has the "menu-open" class
        // var isOpen = 
        // $(this).addClass('menu-is-opening.menu-open');
        // Remove "menu-open" class from all sibling menu items with the "has-treeview" class
        $(this).siblings('.nav-item.has-treeview').removeClass('menu-is-opening menu-open').find("ul").hide();
        console.log($(this).siblings('.nav-item.has-treeview'));
        // // If the clicked menu item was not already open, add the "menu-open" class to it
        // if (!isOpen) {
        //     $(this).addClass('menu-is-opening menu-open');
        // }
    });
</script>
<?php JSRegister::end() ?>