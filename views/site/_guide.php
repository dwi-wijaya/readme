<?php

use yii\helpers\Url;

?>
<div class="col-12 col-lg-6 px-2 my-2" style="">
    <a href="<?= Url::to(['guide', 'slug' => $guide['slug']]) ?>">
        <div class="card card-body card-guide">
            <div class="d-flex" style="gap: 15px;">
                <img class="guide-img" src="<?= Url::base(true) . '/uploads/guides-thumbnail/' . $guide['thumbnail'] ?>" alt="" srcset="">
                <div class="">
                    <h6 class=""><?= $guide['title'] ?></h6>
                    <p style="font-size: small;" class="mb-0 text-muted"><?= $guide['description'] ?></p>
                </div>
            </div>
        </div>
    </a>
</div>