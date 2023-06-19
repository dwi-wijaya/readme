<?php

namespace app\controllers;

use app\models\Notification;
use Yii;

class ModuleController extends \yii\web\Controller
{
    public function actionNotif()
    {
        $notif = Notification::getNotif();
        return json_encode($notif);
    }
    public function actionHasread()
    {
        $id = Yii::$app->request->post('id');
        $notif = Notification::findOne($id);
        $notif->status = 1;
        $notif->save(false);
    }

}
