<?php

namespace app\controllers;

use app\helpers\AuthHelpers;
use app\helpers\DateUtils;
use app\helpers\Utils;
use app\models\Log;
use app\models\User;
use Yii;
use yii\web\Controller;

class LayoutController extends Controller {
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        $user = Yii::$app->user;
        // echo '<pre>';print_r($user->identity->role);die;
        if ($user->isGuest) {
            $this->layout = 'main';
        } elseif (in_array($user->identity->role->item_name, [Utils::ROLE_ADMIN,Utils::ROLE_EDITOR,Utils::ROLE_AUTHOR]) ) {
            $this->layout = 'main-lte';
        }

        return true;
    }
}
