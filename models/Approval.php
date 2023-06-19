<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trs_approval".
 *
 * @property string $idapproval
 * @property string|null $idarticle
 * @property string|null $status
 * @property string|null $approved_date
 * @property string|null $note
 */
class Approval extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trs_approval';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idapproval'], 'required'],
            [['idapproval', 'idarticle', 'status', 'note'], 'string'],
            [['created_at','idreason'], 'safe'],
            [['idapproval'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idapproval' => 'Idapproval',
            'idarticle' => 'Idarticle',
            'status' => 'Status',
            'created_at' => 'Approved Date',
            'note' => 'Note',
            'idreason' => 'Reason',
        ];
    }
    public function getReason()
    {
        return $this->hasOne(mstReason::className(), ['idreason' => 'idreason']);
    }
}
