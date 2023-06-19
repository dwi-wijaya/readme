<?php

namespace app\models;

use app\helpers\Utils;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "assets".
 *
 * @property string|null $idasset
 * @property string|null $asset_name
 * @property string|null $created_at
 * @property string|null $iduser
 */
class Assets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    var $file;
    public static function tableName()
    {
        return 'assets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idasset', 'asset_name', 'created_at', 'iduser'], 'string'],
            [['file'], 'required'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idasset' => 'Idasset',
            'asset_name' => 'Asset Name',
            'created_at' => 'Created At',
            'iduser' => 'Iduser',
        ];
    }
    public static function saveAssets($model)
    {
        $id = User::me()->id;
        $model->idasset = uniqid();
        $model->created_at = date('Y-m-d h:i:s');
        $model->iduser = $id;
        $file = UploadedFile::getInstance($model, 'file');
        if ($file) {
            Utils::createDirectory('/uploads/assets/');
            $filename = $file->name . '-' . uniqid() . '.' . $file->extension;
            $model->asset_name = $filename;
            $file->saveAs('./uploads/assets/' . $filename);
        }
        $model->save(false);
        Utils::flashSuccess('Uploaded');
    }
}
