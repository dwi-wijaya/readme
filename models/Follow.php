<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "follow".
 *
 * @property string $idfollow
 * @property string|null $author_id
 * @property string|null $user_id
 * @property string|null $created_at
 */
class Follow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trs_follow';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idfollow'], 'required'],
            [['idfollow', 'author_id', 'user_id'], 'string'],
            [['created_at'], 'safe'],
            [['idfollow'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idfollow' => 'Idfollow',
            'author_id' => 'Author ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }
}
