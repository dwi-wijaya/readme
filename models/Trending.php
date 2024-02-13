<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "trending".
 *
 * @property string $idtrend
 * @property string|null $iduser
 * @property string|null $idarticle
 * @property string|null $created_at
 * @property bool|null $liked
 */
class Trending extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const TYPE_ARTICLE = 'article';
    const TYPE_GUIDE = 'guide';
    const TYPE_AUTHOR = 'author';

    public static function tableName()
    {
        return 'trs_trending';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtrend'], 'required'],
            [['idtrend', 'iduser', 'item_id', 'created_at', 'item_type'], 'string'],
            [['liked'], 'boolean'],
            [['idtrend'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtrend' => 'Idtrend',
            'iduser' => 'Iduser',
            'idarticle' => 'Idarticle',
            'created_at' => 'Created At',
            'liked' => 'Liked',
        ];
    }
    public static function getPopularGuide()
    {
        $query = (new Query())
            ->select(['COUNT(*) count', 'g.*'])
            ->from(['g' => Guides::tableName()])
            ->innerJoin(['tr' => self::tableName()], 'tr.item_id=g.idguide COLLATE utf8mb4_unicode_ci')
            ->groupBy('g.idguide')
            ->orderBy(['count' => SORT_DESC])
            ->limit(4)
            ->all();

        return $query;
    }
    public static function saveTransaction($model, $type)
    {
        $trend = new Trending();
        $itemId = static::getItemId($model, $type);
        $trend->idtrend = uniqid();
        $trend->item_id = $itemId;
        $trend->item_type = $type;
        $trend->iduser = User::me() ? User::me()->username : null; // Mengganti string kosong dengan null
        $trend->created_at = date('Y-m-d H:i:s'); // Menggunakan format 24 jam
        $trend->save();
    }

    protected static function getItemId($model, $type)
    {
        switch ($type) {
            case self::TYPE_ARTICLE:
                return $model->idarticle;
            case self::TYPE_GUIDE:
                return $model->idguide;
            case self::TYPE_AUTHOR:
                return $model->author_id;
            default:
                throw new \InvalidArgumentException('Invalid item type.');
        }
    }
}
