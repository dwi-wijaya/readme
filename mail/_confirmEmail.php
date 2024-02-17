<?php

use yii\helpers\Url;

?>

<div class="" style="background-color: #f9f9f9;padding: 2rem 0 ">
    <div style="margin: 0 auto; max-width: 600px; padding: 3rem; border-radius: 10px; background-color: white; border: 1px solid #f2f3f4; font-family: 'Poppins', sans-serif;">
        <div style="text-align: center;">

            <p style="font-size: 14px; line-height: 20px; color: #4f5660; display: block;" class="text-muted">
                Hi <b><?= $username ?></b>, <br>
                You requested to change the email address on your Readme Account. Please click the link below to confirm this action.
            </p>

            <a href="<?= Url::to(['site/verify-email', 'token' => $token, 'isAuthorized' => true], true) ?>" style="text-decoration: none; background-color: #e67373; color: white; padding: 10px 20px; border-radius: 5px; text-align: center; display: inline-block; margin-top: 1rem;">
                Verify Email
            </a>

            <span style="font-size: 14px; line-height: 20px; color: #4f5660; display: block;margin-top: 1rem;" class="text-muted">
                If you did not request any changes, simply ignore or delete this email
            </span>
            <hr style="margin: 2rem 0;border: 1px solid #f2f3f4;">
            <p style="font-size: 11px; line-height: 20px; color: #4f5660;margin-top: 1rem;text-align: center;">Send by Readme &nbsp;-&nbsp; <a href="https://readme.com">Check Our Blog</a> &nbsp;-&nbsp; @readme.</p>
        </div>
    </div>
</div>