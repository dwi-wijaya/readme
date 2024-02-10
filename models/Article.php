<?php

namespace app\models;

use app\helpers\Utils;
use PhpParser\Node\Stmt\Return_;
use PHPUnit\Framework\Constraint\ArrayHasKey;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "article".
 *
 * @property string $idarticle
 * @property string|null $title
 * @property string|null $subtitle
 * @property string|null $created_at
 * @property string|null $tag
 * @property string|null $content
 * @property string|null $author_id
 * @property string|null $thumbnail
 * @property string|null $cetegory
 * @property string|null $updated_at
 * @property string|null $status
 * @property string|null $slug
 * @property string|null $editor_id
 * @property string|null $approved_at
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    var $article_tag;
    var $search;
    var $file;

    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idarticle', 'title'], 'required'],
            [['idarticle', 'title', 'subtitle', 'tag', 'content', 'author_id', 'thumbnail', 'cetegory','idcat', 'status', 'slug', 'approved_by'], 'string'],
            [['created_at', 'updated_at', 'approved_at', 'article_tag', 'search',], 'safe'],
            [['title'], 'unique'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpeg,jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idarticle' => 'Idarticle',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'created_at' => 'Created At',
            'tag' => 'Tag',
            'idcat' => 'Category',
            'content' => 'Content',
            'author_id' => 'Author ID',
            'thumbnail' => 'Thumbnail',
            'cetegory' => 'Cetegory',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'slug' => 'Slug',
            'approved_by' => 'Editor ID',
            'approved_at' => 'Approved At',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['username' => 'author_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(mstCategory::className(), ['idcategory' => 'idcat']);
    }

    public static function topArticle()
    {
        $top = (new Query())
            ->select(['count(*) as total', 'idarticle'])
            ->from(Trending::tableName())
            ->groupBy('idarticle');
        return $top;
    }

    public static function getMostviewed()
    {
        $viewed = self::topArticle();

        $query = (new Query())
            ->select(['a.*', 't.total'])
            ->from(['a' => self::tableName()])
            ->innerJoin(['t' => $viewed], 'a.idarticle=t.idarticle')
            ->orderBy(['total' => SORT_DESC])->limit(6)->all();

        return $query;
    }

    public static function getArticlebyuser($id)
    {
        $article = Article::find()
            ->innerJoin(['a' => Users::find()->where(['username' => $id])], 'a.username=article.author_id')
            ->orderBy(['created_at' => SORT_DESC]);
        return $article;
    }

    public static function getMostviewedbyuser($id)
    {
        $viewed = self::topArticle();

        $query = (new Query())
            ->select(['a.*', 't.total'])
            ->from(['a' => self::tableName()])
            ->innerJoin(['t' => $viewed], 'a.idarticle=t.idarticle')
            ->innerJoin(['au' => Users::tableName()], 'au.username=a.author_id')
            ->where(['author_id' => $id])
            ->orderBy(['total' => SORT_DESC])
            ->limit(4)
            ->all();

        return $query;
    }

    public static function search($model, $idcat = null)
    {
        $search = Article::find()
            ->orFilterWhere(['like', 'upper(title)', strtoupper($model->search)])
            ->orFilterWhere(['like', 'tag', $model->search])
            ->andFilterWhere(['idcat' => $idcat])
            ->orderBy(['created_at' => SORT_DESC]);
        return $search;
    }

    public static function Unapproved($model)
    {
        $query = Article::find()
            ->where(['in','status', [Utils::STAT_IN_REVIEW,Utils::STAT_DONE]])
            ->andFilterWhere(['idcat' => $model->idcat]);

        return $query;
    }

    public static function reject($items)
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        $flag = true;
        foreach ($items as $key => $idmap) {
            $mSave = Article::findOne($idmap);

            if ($mSave) {
                $flag = true;
                $mSave->status = 0;
                $mSave->date_reject = date('Y-m-d');
                $mSave->user_reject =  User::me()->id;
                $mSave->isapproved = Utils::REJECT;
                // $mSave->isgangguan = (string) $mSave->isgangguan;
                // $mSave->iduser = User::me()->id;
                $mSave->save();
            } else {
                $flag = false;
            }
        }

        if ($flag) {
            $transaction->commit();
            Utils::flashSuccess('Berhasil reject Map');
            return true;
        } else {
            $transaction->rollBack();
            Utils::flashFailed('Gagal reject Map');
            return false;
        }
    }

    public static function approve($items)
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        $flag = true;
        foreach ($items as $key => $idmap) {
            $mSave = Article::findOne($idmap);
            if ($mSave) {
                $flag = true;
                $mSave->status = Utils::APPROVED;
                $mSave->approved_at = date('Y-m-d h:i:s');
                $mSave->approved_by = User::me()->id;
                $mSave->save(false);
            } else {
                $flag = false;
            }
        }
        if ($flag) {
            $transaction->commit();
            Utils::flashSuccess('Berhasil Approve Map');
            return true;
        } else {
            $transaction->rollBack();
            Utils::flashFailed('Gagal Approve Map');
            return false;
        }
    }
    public static function saveArticle($model)
    {
        $model->created_at = date('Y-m-d h:i:s');
        $model->idarticle = Utils::getID();
        $file = UploadedFile::getInstance($model, 'file');
        if ($file) {
            Utils::createDirectory('/uploads/article/thumbnail/');

            $filename = uniqid() . '_' . $model->slug . '.' . $file->extension;;
            $model->thumbnail = $filename;
            $file->saveAs('./uploads/article/thumbnail/' . $filename);
        }
        if ($model->article_tag != null) {
            $model->tag = implode(', ', $model->article_tag);
        }
        $model->author_id = User::me()->id;
        $model->save();
    }
    public static function getStatus()
    {
        $stat = [
            'REJECT' => -2,
            'REVISION' => -1
        ];
        return $stat;
    }

    public static function countbyCat()
    {

        $query = (new Query())
            ->select(['idcat,count(*) as total'])
            ->from(self::tableName())
            ->groupBy(['idcat']);

        return $query;
    }

    public static function getFollowing()
    {
        $query = (new Query())
            ->select(['a.*'])
            ->from(['a' => self::tableName()])
            ->innerJoin(['f' => Follow::find()->where(['user_id' => User::me()->id])], 'a.author_id=f.author_id')
            ->orderBy(['created_at' => SORT_DESC]);

        return $query;
    }
    public static function findbyCat($id)
    {
        $query = (new Query())
            ->select(['a.*'])
            ->from(['a' => self::tableName()])
            ->where(['idcat' => $id])
            ->all();
        return $query;
    }

    public static function statChart($id)
    {

        $dateLabel = ['x'];
        $viewLabel = ['viewed'];

        $query = (new Query())
            ->select(['count(*) as viewed', 'date(t.created_at) created_at'])
            ->from(['t' => Trending::tableName()])
            ->where(['idarticle' => $id])
            ->groupBy('date(created_at)')
            ->all();

        $dateColumn = ArrayHelper::getColumn($query, 'created_at');
        $viewColumn = ArrayHelper::getColumn($query, 'viewed');

        $fdate[] = array_merge($dateLabel, $dateColumn);
        $fview[] = array_merge($viewLabel, $viewColumn);

        $column = array_merge($fdate, $fview);

        return json_encode($column);
    }

    public static function statistic($id)
    {
        $query = (new Query())
            ->select(['a.*', 'c.name catname', 'l.clike', 'b.cbookmark', 'v.view'])
            ->from(['a' => self::find()->where(['idarticle' => $id])])
            ->innerJoin(['c' => mstCategory::tableName()], 'c.idcat=a.idcat')
            ->leftJoin([
                'l' => (new Query())
                    ->select(['count(*) clike', 'idarticle'])
                    ->from(Like::tableName())
                    ->groupBy('idarticle')
            ], 'l.idarticle=a.idarticle')
            ->leftJoin([
                'b' => (new Query())
                    ->select(['count(*) cbookmark', 'idarticle'])
                    ->from(Bookmark::tableName())
                    ->groupBy('idarticle')
            ], 'b.idarticle=a.idarticle')
            ->leftJoin([
                'v' => (new Query())
                    ->select(['count(*) view', 'idarticle'])
                    ->from(Trending::tableName())
                    ->groupBy('idarticle')
            ], 'v.idarticle=a.idarticle')
            ->one();

        return $query;
    }
}
