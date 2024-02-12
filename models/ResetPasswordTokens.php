<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reset_password_tokens".
 *
 * @property int $id
 * @property string $user_id
 * @property string $token
 * @property string $expires_at
 * @property int $status
 * @property string|null $created_at
 */
class ResetPasswordTokens extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reset_password_tokens';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'token', 'expires_at'], 'required'],
            [['expires_at', 'created_at'], 'safe'],
            [['status'], 'integer'],
            [['user_id'], 'string', 'max' => 64],
            [['token'], 'string', 'max' => 255],
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
            'token' => 'Token',
            'expires_at' => 'Expires At',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
    public function isExpired()
    {
        return strtotime($this->expires_at) < time();
    }

    public function isUsed()
    {
        return $this->status == 1;
    }

    public static function createToken($userId, $resetPasswordToken)
    {
        $tokenModel = new ResetPasswordTokens();
        $tokenModel->user_id = $userId;
        $tokenModel->token = $resetPasswordToken;
        $tokenModel->expires_at = date('Y-m-d H:i:s', strtotime('+1 hour')); // Set expiration time, misalnya 1 jam dari sekarang
        $tokenModel->save();
        return $tokenModel;
    }

    public function markAsUsed()
    {
        $this->status = 1;
        return $this->save(false); // Save without validation
    }

    public static function findByToken($token)
    {
        return static::findOne(['token' => $token]);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['username' => 'user_id']);
    }
}
