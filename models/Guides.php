<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "guides".
 *
 * @property string $idguide
 * @property string $title
 * @property string|null $thumbnail
 * @property string|null $description
 * @property string|null $author
 * @property string|null $level
 * @property string|null $created_at
 */
class Guides extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guides';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idguide', 'title'], 'required'],
            [['created_at'], 'safe'],
            [['idguide', 'title', 'thumbnail', 'description', 'level'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 64],
            [['idguide'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idguide' => 'Idguide',
            'title' => 'Title',
            'thumbnail' => 'Thumbnail',
            'description' => 'Description',
            'author' => 'Author',
            'level' => 'Level',
            'created_at' => 'Created At',
        ];
    }
}
