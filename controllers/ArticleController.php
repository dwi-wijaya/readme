<?php

namespace app\controllers;

use app\helpers\Utils;
use app\models\Approval;
use app\models\Article;
use app\models\Assets;
use app\models\Bookmark;
use app\models\Favorite;
use app\models\Follow;
use app\models\Like;
use app\models\mstCategory;
use app\models\mstTag;
use app\models\Trending;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends LayoutController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Article models.
     *
     * @return string
     */

    public function actionSubmission()
    {
        $model = new Article();
        $query = Article::Unapproved($model);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);
        return $this->render('approval', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionReview($id)
    {
        $model = Article::findOne($id);
        $approval = new Approval();
        if ($this->request->isPost) {
            if ($approval->load($this->request->post())) {
                $approval->idarticle = $model->idarticle;
                $approval->idapproval =  Utils::getID();
                $approval->created_at = date('Y-m-d h:i:s');
                if ($approval->save()) {
                    $model->status = $approval->status;
                    $model->save();
                    Utils::sendNotif(User::me()->id, $model->author_id, $approval->status, $model->idarticle, Utils::getNotificon($approval->status));
                }
                return $this->redirect(['submission', 'id' => $model->idarticle]);
            }
        }
        return $this->render('review', [
            'model' => $model,
            'approval' => $approval,
        ]);
    }
    public function actionAjaxApproved()
    {
        if (Yii::$app->request->post()) {
            $items = Yii::$app->request->post('data');
            if (in_array("reject", explode('-', $items))) {
                $model =  Article::reject(explode('-', str_replace("reject-", "", $items)));
            } else {
                $model =  Article::approve(explode('-', $items));
            }
            return $this->redirect(['approval']);
        }
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find(),
            'pagination' => [
                'pageSize' => 15
            ],
            'sort' => [
                'defaultOrder' => [
                    'idarticle' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionListArticle()
    {
        $model = new Article();
        $id = User::me()->id;
        $article = Article::find()->where(['author_id' => $id])->groupBy(['status', 'idarticle'])->orderBy(['status' => SORT_ASC]);
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find()->where(['author_id' => $id])->andWhere(['not in', 'status', Utils::STAT_APPROVED])->groupBy(['status', 'idarticle'])->orderBy(['status' => SORT_ASC])
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'idarticle' => SORT_DESC,
                ]
            ],
            */
        ]);

        $all = new ActiveDataProvider([
            'query' => $article
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'idarticle' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('list_article', [
            'dataProvider' => $dataProvider,
            'all' => $all,
            'article' => $article->all(),
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param string $idarticle Idarticle
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionStatistic()
    {
        if (Utils::req()->isAjax) {
            $req = Yii::$app->request;
            $data = $req->post('data');
            $id = isset($data) ? $data : NULL;

            $dataChart = Article::statChart($id);
            $model = Article::statistic($id);

            return $this->renderAjax('statistic', [
                'chart' => $dataChart,
                'model' => $model,
            ]);
        }
    }

    public function actionDetail($id)
    {
        $model = Article::find()->joinWith('user')->where(['slug' => $id])->one();
        $related = Article::find()->where(['like', 'tag', $model->tag])->andWhere(['not in', 'idarticle', $model->idarticle])->limit(9)->all();
        $app = new Approval();

        $bookmark = '';
        $like = '';

        if (Yii::$app->user->isGuest) {
            Trending::saveTransaction($model);
        } else {
            Trending::saveTransaction($model);
            $userId = User::me()->id;

            $bookmark = Bookmark::find()->where(['iduser' => $userId, 'idarticle' => $model->idarticle])->one();
            $like = Like::find()->where(['iduser' => $userId, 'idarticle' => $model->idarticle])->one();
            $bookmark = $bookmark ? true : false;
            $like = $like ? $like->is_like : null;
        }

        return $this->render('detail', [
            'model' => $model,
            'app' => $app,
            'related' => $related,
            'bookmark' => $bookmark,
            'like' => $like,
        ]);
    }

    public function actionBookmark()
    {
        $id = Yii::$app->request->post('id');
        $userId = User::me()->id;

        $bookmark = Bookmark::find()->where(['iduser' => $userId, 'idarticle' => $id])->one();

        if ($bookmark === null) {
            // Save the bookmark
            $bookmark = new Bookmark();

            $bookmark->idbookmark = uniqid();
            $bookmark->iduser = $userId;
            $bookmark->idarticle = $id;
            $bookmark->created_at = date('Y-m-d h:i:s');
            $bookmark->save();
            Yii::$app->session->setFlash('success', 'Bookmark saved!');
            return json_encode('1');
        } else {
            $bookmark->delete();
            Yii::$app->session->setFlash('error', 'Bookmark already added!');
            return json_encode('0');
        }
    }

    public function actionLike()
    {
        $id  = Yii::$app->request->post('id');
        $userId = User::me()->id;

        $like = Like::find()->where(['iduser' => $userId, 'idarticle' => $id])->one();

        if ($like === null) {
            // Save the bookmark
            $like = new Like();

            $like->idlike = uniqid();
            $like->iduser = $userId;
            $like->idarticle = $id;
            $like->is_like = true;
            $like->created_at = date('Y-m-d h:i:s');
            $like->save();
            Yii::$app->session->setFlash('success', 'Bookmark saved!');
            return json_encode('1');
        } else {
            $like->delete();
            Yii::$app->session->setFlash('error', 'Bookmark already added!');
            return json_encode('0');
        }
    }
    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $id = User::me()->id;
        $model = new Article();
        $asset = new Assets();

        $myasset =  Assets::find()->where(['iduser' => $id])->all();

        $tag = ArrayHelper::map(mstTag::find()->all(), 'tagname', 'tagname');
        $cat = ArrayHelper::map(mstCategory::find()->all(), 'idcat', 'name');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) || $asset->load($this->request->post())) {
                Article::saveArticle($model);
                return $this->redirect(['view', 'id' => $model->idarticle]);
            }
        } else {
            $model->loadDefaultValues();
        } 

        return $this->render('create', [
            'model' => $model,
            'asset' => $asset,
            'myasset' => $myasset,
            'tag' => $tag,
            'cat' => $cat
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $idarticle Idarticle
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tag = ArrayHelper::map(mstTag::find()->all(), 'tagname', 'tagname');
        $cat = ArrayHelper::map(mstCategory::find()->all(), 'idcat', 'name');
        $approval = null;
        if (in_array($model->status, [Utils::STAT_REJECT, Utils::STAT_REVISION])) {
            $approval = Approval::find()->with('reason')->where(['idarticle' => $model->idarticle])->orderBy(['created_at' => SORT_DESC])->one();
        }
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->updated_at = date('Y-m-d h:i:s');
            $file = UploadedFile::getInstance($model, 'file');
            if ($file) {
                is_file('./uploads/article/thumbnail/' . $model->thumbnail) && unlink('./uploads/article/thumbnail/' . $model->thumbnail);
                $filename = uniqid() . '_' . $model->slug . '.' . $file->extension;;
                $model->thumbnail = $filename;

                $file->saveAs('./uploads/article/thumbnail/' . $filename);
            }
            if ($model->article_tag != null) {
                $model->tag = implode(', ', $model->article_tag);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->idarticle]);
        }

        return $this->render('update', [
            'model' => $model,
            'tag' => $tag,
            'approval' => $approval,
            'cat' => $cat
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $idarticle Idarticle
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $idarticle Idarticle
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne(['idarticle' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
