<?php

use app\models\User;

?>
<h3 class="text-white fw-800 mb-0">👋 Hi <?= User::me()->username; ?>,</h3>
<small class="text-white ">Welcome back. Enjoy managing your platform efficiently.</small>
<br><br>
<style>
    .btn-main {
        background: #f17f4663;
        color: #f17f46;
        border: none;
    }

    .card-dashboard {
        border-radius: 8px;
    }
</style>
<div class="row">
    <div class="col">
        <div class="card card-body card-dashboard p-3">
            <small class="text-muted"><button class="btn btn-main fa-solid fa-user mr-1"></button> User Active</small>
            <h4 class="mt-2">81</h4>
        </div>
    </div>
    <div class="col">
        <div class="card card-body card-dashboard p-3">
            <small class="text-muted"><button class="btn btn-main fa-solid fa-user mr-1"></button> User Active</small>
            <h4 class="mt-2">81</h4>
        </div>
    </div>
    <div class="col">
        <div class="card card-body card-dashboard p-3">
            <small class="text-muted"><button class="btn btn-main fa-solid fa-user mr-1"></button> User Active</small>
            <h4 class="mt-2">81</h4>
        </div>
    </div>
    <div class="col">
        <div class="card card-body card-dashboard p-3">
            <small class="text-muted"><button class="btn btn-main fa-solid fa-user mr-1"></button> User Active</small>
            <h4 class="mt-2">81</h4>
        </div>
    </div>
</div>