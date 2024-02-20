<!-- Control Sidebar -->
<?php

use app\models\Assets;
use app\models\User;
use richardfan\widget\JSRegister;

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
<?php JSRegister::begin() ?>
<script>
    // Fungsi untuk mendapatkan semua cookie
function getAllCookies() {
    var cookies = document.cookie.split(';');
    var cookieObject = {};
    cookies.forEach(function(cookie) {
        var parts = cookie.split('=');
        var name = parts[0].trim();
        var value = decodeURIComponent(parts[1]);
        cookieObject[name] = value;
    });
    return cookieObject;
}

// Fungsi untuk mencetak semua cookie ke konsol
function logAllCookies() {
    var allCookies = getAllCookies();
    console.log(allCookies);
}

// Menambahkan event listener pada semua checkbox
var checkboxes = document.querySelectorAll('input[type="checkbox"]');
checkboxes.forEach(function(checkbox) {
    console.log('tes');
    checkbox.addEventListener('change', function(event) {
        // Memeriksa apakah perubahan terjadi pada checkbox
            // Jika ya, mencetak semua cookie ke konsol
            logAllCookies();
    });
});

</script>
<?php JSRegister::end() ?>
