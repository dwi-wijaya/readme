<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bookmark".
 *
 * @property string $idbookmark
 * @property string|null $idarticle
 * @property string|null $iduser
 * @property string|null $created_at
 */
class Bookmark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trs_bookmark';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idbookmark'], 'required'],
            [['idbookmark', 'idarticle', 'iduser'], 'string'],
            [['created_at'], 'safe'],
            [['idbookmark'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idbookmark' => 'Idbookmark',
            'idarticle' => 'Idarticle',
            'iduser' => 'Iduser',
            'created_at' => 'Created At',
        ];
    }
}
