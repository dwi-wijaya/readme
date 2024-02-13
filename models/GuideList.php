<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "guide_list".
 *
 * @property string $idguide_list
 * @property string $idarticle
 * @property string|null $order
 * @property string|null $created_at
 */
class GuideList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guide_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idguide_list', 'idarticle','idguide'], 'required'],
            [['created_at'], 'safe'],
            [['idguide_list', 'idarticle', 'order'], 'string', 'max' => 255],
            [['idguide_list'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idguide_list' => 'Idguide List',
            'idarticle' => 'Idarticle',
            'order' => 'Order',
            'created_at' => 'Created At',
        ];
    }
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['idarticle' => 'idarticle']);
    }
}
