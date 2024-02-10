<?php

use app\helpers\Utils;
use app\models\User;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Users $model */
// echo '<pre>';print_r($model->iduser === User::me()->id;);die;
$this->title = $model->username;
\yii\web\YiiAsset::register($this);
?>
<style>
    .profile-img {
        height: 200px;
        width: 200px !important;
        border-radius: 50% !important;
    }

    .profile {
        gap: 2rem;
        display: flex;
        align-items: center;
    }

    .follow-btn {
        height: fit-content;
        position: absolute;
        right: 0;
    }

    .card-title {
        font-size: 1rem !important;
    }

    .card-subtitle {
        margin-top: .3rem;
        font-size: .75rem !important;
    }

    .created_at {
        font-size: .75rem;
    }

    .article-card {
        min-height: 18rem !important;
    }

    form {
        display: flex;
        float: right;
    }

    .latest {
        display: flex;
        width: 100%;
        height: fit-content;
        overflow-x: auto;
        padding-bottom: 1rem;
    }

    h4 {
        font-weight: 600;
    }

    .tablist {
        display: flex;
        justify-content: space-around;
    }
</style>
<div class="users-view">


    <div class="row mt-5">
        <div class="col-3">
            <div class="profile-photo">
                <?php if ($model->profile_picture) : ?>
                    <img class="thumbnail b-10 w-100 profile-img" src="<?= Utils::baseUploadsProfile($model->profile_picture); ?>" alt="" class="b-10">
                <?php else : ?>
                    <img class="thumbnail b-10 w-100 profile-img" src="<?= Utils::baseUploadsStock('user.png'); ?>" alt="" class="b-10">
                <?php endif ?>
            </div>
        </div>
        <div class="col-8">
            <small class="m-0 text-muted">@<?= $model->username; ?></small>
            <div class="profile">
                <h1 class="fw-700"><?= $model->first_name . ' ' . $model->last_name; ?></h1>
                <?php if (User::me()->username === $model->username) : ?>
                    <div class="group-btn">
                        <a id="" class="b-10 btn btn-secondary "><i class="fa-solid fa-pen"></i> &nbsp; Update</a>
                        <a href="<?= Url::to(['site/setting']); ?>" id="" class="b-10 btn btn-primary"><i class="fa-solid fa-gear"></i></a>
                    </div>
                <?php endif ?>
                <?php if ($model->role == Utils::ROLE_AUTHOR) : ?>
                    <a id="follow" class="b-10 follow-btn btn btn-primary " data="<?= $model->iduser; ?>"><i class="fa-solid fa-user-plus"></i> &nbsp; Follow</a>
                <?php endif ?>
            </div>
            <p><b><?= $stat['article']; ?></b> Articles / <b><?= $stat['follower']; ?></b> Followers</p>
            <p class="fw-300"><?= $model->bio; ?></p>
            <div class="badge m-0">
                <p>badge :</p>
            </div>
        </div>
    </div>
    <hr>
    <?php if ($model->role->item_name == Utils::ROLE_AUTHOR) : ?>
        <?= $this->render('_account_author',[
            'articlemodel' => $articlemodel,
            'top' => $top,
            'latest' => $latest,
        ]) ?>
    <?php elseif ($model->role->item_name == Utils::ROLE_SUBCRIBER) : ?>
        <?= $this->render('_account_subscriber',[
            'liked' => $liked,
            'bookmark' => $bookmark
        ]) ?>
    <?php endif ?>
</div>


<?php JSRegister::begin() ?>
<script>
    $('#follow').click(function() {
        var id = $(this).attr('data');
        var $icon = $(this).find('i');

        $.ajax({
            url: '<?= Url::to(['users/follow']) ?>',
            type: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                var isbookmark = JSON.parse(data);
                console.log(isbookmark);
                if (isbookmark == 1) {
                    $icon.removeClass('fa-regular fa-user-plus').addClass('fa-solid fa-user-check');
                } else {
                    $icon.removeClass('fa-solid fa-user-check').addClass('fa-solid fa-user-plus');
                }
            }
        })
    })

    $('#tab-like').click(function() {
        $('#tab-bookmark').find('li').removeClass('fa-solid').addClass('fa-regular')
        $(this).find('li').removeClass('fa-regular').addClass('fa-solid')
        $('#content-bookmark').hide(500);
        $('#content-like').show(500);
    })
    $('#tab-bookmark').click(function() {
        $('#tab-like').find('li').removeClass('fa-solid').addClass('fa-regular')
        $(this).find('li').removeClass('fa-regular').addClass('fa-solid')
        $('#content-bookmark').show(500);
        $('#content-like').hide(500);
    })
</script>
<?php JSRegister::end() ?>