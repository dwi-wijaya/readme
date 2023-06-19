<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "like".
 *
 * @property string|null $idlike
 * @property string|null $iduser
 * @property string|null $idarticle
 * @property bool|null $is_like
 * @property string|null $datecreated
 */
class Like extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trs_like';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idlike', 'iduser', 'idarticle'], 'string'],
            [['is_like'], 'boolean'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idlike' => 'Idlike',
            'iduser' => 'Iduser',
            'idarticle' => 'Idarticle',
            'is_like' => 'Is Like',
            'datecreated' => 'Datecreated',
        ];
    }
}
