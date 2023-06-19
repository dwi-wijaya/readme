<?php

namespace app\models;

use app\helpers\Utils;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property string|null $idnotification
 * @property string|null $sender_id
 * @property string|null $recipient_id
 * @property string|null $type
 * @property string|null $idarticle
 * @property string|null $created_at
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trs_notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idnotification', 'sender_id', 'recipient_id', 'type', 'idarticle', 'route', 'created_at', 'icon','mark_at'], 'string'],
            [['status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idnotification' => 'Idnotification',
            'sender_id' => 'Sender ID',
            'recipient_id' => 'Recipient ID',
            'type' => 'Type',
            'idarticle' => 'Idarticle',
            'created_at' => 'Created At',
        ];
    }

    public static function getNotif()
    {
        $me = User::me()->id;

        $query = Notification::find()->where(['recipient_id' => $me])->andWhere(['status' => null])->orderBy(['created_at' => SORT_ASC])->asArray()->all();
        return $query;
    }

    public static function readNotif($id){
        $notif = self::findOne($id);
        $notif->status = Utils::STATUS_READ;
        $notif->mark_at = date('Y-m-d h:i:s');
        $notif->save();
    }
}
