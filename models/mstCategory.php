<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "mst_category".
 *
 * @property string $idcat
 * @property string|null $name
 * @property string|null $slug
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class mstCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcat'], 'required'],
            [['idcat', 'name', 'slug'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['idcat'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcat' => 'Idcat',
            'name' => 'Category',
            'slug' => 'Slug',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public static function getCategory($id= null){
        $query = (new Query())
        ->select(['c.*','a.total'])
        ->from(['c' => self::tableName()])
        ->leftJoin(['a' => Article::countbyCat()],'a.idcat=c.idcat')
        ->andFilterWhere(['c.idcat' => $id]);

        return $query;
    }
    public static function getList(){
        $cat = self::find()->all();
        return ArrayHelper::map($cat ,'idcat','name');
    }
}
