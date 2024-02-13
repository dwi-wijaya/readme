<?php

namespace app\models;

use app\helpers\Utils;
use Yii;
use yii\helpers\Inflector;
use yii\web\UploadedFile;

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
    var $file;
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
            [['idguide', 'title', 'slug','pretext', 'thumbnail', 'description', 'level'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 64],
            [['idguide'], 'unique'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpeg,jpg,webp,svg',],
        ];
    }

    public function getList() {
        return $this->hasMany(GuideList::className(), ['idguide' => 'idguide']);
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
    public function saveGuide()
    {
        $this->idguide = uniqid();
        $this->slug = Inflector::slug($this->title);
        $this->author = User::me()->username;
        $this->created_at = date('Y-m-d H:i:s');
        $file = UploadedFile::getInstance($this, 'file');
        if ($file) {
            Utils::createDirectory('/uploads/guides-thumbnail/');

            $filename = uniqid() . '_' . $this->slug . '.' . $file->extension;;
            $this->thumbnail = $filename;
            $file->saveAs('./uploads/guides-thumbnail/' . $filename);
        }
        if (!$this->save()) {
            Utils::flashFailed("Failed to save Guide");
        }
        return true;
    }
    public static function getGuides(){
        $query = Guides::find()->all();
    }
}
