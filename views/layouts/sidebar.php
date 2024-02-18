<?php

use app\helpers\Utils;
use app\models\mstMenu;
use app\models\User;
use mdm\admin\components\Helper;
use richardfan\widget\JSRegister;
use yii\helpers\Url;

$this->registerCssFile('@web/css/pages/sidebar.css');
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #3652AD !important;">
    <!-- Brand Logo -->
    <a href="<?= Url::home()?>" style="transition: none !important;background: transparent !important;" class="brand-link" >
        <i style="margin-top: 2px;font-size: 30px;color: #565656;" class="fa-regular fa-newspaper brand-image text-main elevation-3"></i>
        <span class="brand-text font-weight-light text-main ml-1">Readme</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel pt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img style="" src="<?= Utils::baseUploadsProfile(User::me()->profile_picture); ?>" alt="" class="img-circle ">

            </div>
            <div class="white">
                <a style="padding-top: 5px;padding-left: 15px;" href="<?= Url::to(['/users/account', 'id' => User::me()->username]); ?>" class="d-block"><?= User::me()->first_name . ' ' . User::me()->last_name; ?>
                </a>

            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php


            $item = mstMenu::getNavbarLTE();

            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => $item,
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