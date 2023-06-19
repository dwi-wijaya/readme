<?php

namespace app\models;

use Yii;

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
            [['idtrend', 'iduser', 'idarticle', 'created_at'], 'string'],
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
    public static function saveTransaction($model = NULL){
        $trend = new Trending();
        
        $trend->idtrend = uniqid();
        $trend->idarticle = $model->idarticle;
        $trend->iduser = User::me() ? User::me()->id : '';
        $trend->created_at = date('Y-m-d h:i:s');
        $trend->save();
    }

}
