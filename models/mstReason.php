<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mst_reason".
 *
 * @property string|null $idreason
 * @property string|null $reason
 */
class mstReason extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_reason';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idreason', 'reason','flag'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idreason' => 'Idreason',
            'reason' => 'Reason',
            'flag' => 'Flag',
        ];
    }
}
