<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "otp_codes".
 *
 * @property int $id
 * @property string $user_id
 * @property string $otp_code
 * @property string|null $created_at
 * @property string|null $expired_at
 */
class OtpCodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'otp_codes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'otp_code'], 'required'],
            [['created_at', 'expired_at'], 'safe'],
            [['user_id'], 'string', 'max' => 64],
            [['otp_code'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'otp_code' => 'Otp Code',
            'created_at' => 'Created At',
            'expired_at' => 'Expired At',
        ];
    }
    public static function saveOtpCode($userId, $otpCode){
        $otpRecord = new OtpCodes();
            $otpRecord->user_id = $userId; // Assuming there's a user_id property in AuthForm
            $otpRecord->otp_code = (string) $otpCode;
            $otpRecord->created_at = date('Y-m-d H:i:s'); // Current timestamp
            $otpRecord->expired_at = date('Y-m-d H:i:s', strtotime('+5 minutes')); // 5 minutes from now
            $otpRecord->save();
            return $otpRecord;

    }
    public static function findOtpCode($userId, $otp){
        $query = OtpCodes::find()
        ->where(['user_id' => $userId])
        ->andWhere(['otp_code' => $otp])
        ->andWhere(['>=', 'expired_at', date('Y-m-d H:i:s')])
        ->orderBy(['created_at' => SORT_DESC])
        ->one();
        return $query;
    }
}
