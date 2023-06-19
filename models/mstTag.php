<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mst_tag".
 *
 * @property string $idtag
 * @property string|null $tagname
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $slug
 */
class mstTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtag'], 'required'],
            [['idtag', 'tagname', 'slug'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['idtag'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtag' => 'Idtag',
            'tagname' => 'Tagname',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'slug' => 'Slug',
        ];
    }
}
