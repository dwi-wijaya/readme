<!-- Control Sidebar -->
<?php

use app\models\Assets;
use app\models\User;

$id = User::me()->username;
$asset = new Assets();

$myasset =  Assets::find()->where(['iduser' => $id])->all();
?>
<style>
    .control-sidebar {
        z-index: 2 !important;
        height: 100%;
        /* width: 600px !important; */
    }
    .control-sidebar, .control-sidebar {
    /* bottom: calc(3.5rem + 1px); */
    /* display: none; */
    right: -600px ;
    width: 600px !important;
    /* transition: right .3s ease-in-out,display .3s ease-in-out; */
    }
    
</style>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
   
</aside>
<!-- /.control-sidebar -->