<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_progress".
 *
 * @property string $iduser_progress
 * @property string $user_id
 * @property string $idguide_list
 * @property int|null $is_completed
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class UserProgress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_progress';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iduser_progress', 'user_id', 'idguide_list','idguide'], 'required'],
            [['is_completed'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['iduser_progress', 'idguide_list'], 'string', 'max' => 255],
            [['user_id'], 'string', 'max' => 64],
            [['iduser_progress'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iduser_progress' => 'Iduser Progress',
            'user_id' => 'User ID',
            'idguide_list' => 'Idguide List',
            'is_completed' => 'Is Completed',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
