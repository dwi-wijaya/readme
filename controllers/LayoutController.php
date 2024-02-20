<?php

namespace app\controllers;

use app\helpers\AuthHelpers;
use app\helpers\DateUtils;
use app\helpers\Utils;
use app\models\Log;
use app\models\User;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class LayoutController extends Controller
{
    public function behaviors()
    {
        return AuthHelpers::behaviors();
    }
    public function beforeAction($action)
    {
        $user = Yii::$app->user;

        if (!parent::beforeAction($action)) {
            return false;
        }
        // echo '<pre>';print_r($user->identity->role);die;
        if ($user->isGuest) {
            $this->layout = 'main';
            Yii::$app->setHomeUrl(Url::to(['site']));
        } elseif (in_array(User::me()->role->item_name, [Utils::ROLE_ADMIN, Utils::ROLE_EDITOR, Utils::ROLE_AUTHOR])) {
            Yii::$app->setHomeUrl(Url::to(['/dashboard']));
            $this->layout = 'main-lte';
        }

        return true;
    }
}
