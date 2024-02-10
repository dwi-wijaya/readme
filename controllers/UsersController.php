<?php

namespace app\controllers;

use app\helpers\Utils;
use app\models\Article;
use app\models\AuthAssignment;
use app\models\Bookmark;
use app\models\Follow;
use app\models\Like;
use app\models\Trending;
use app\models\User;
use app\models\Users;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends LayoutController
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
     * Lists all Users models.
     *
     * @return string
     */
    public function actionAuthor()
    {
        $model = new User();
        $dataProvider = new ActiveDataProvider([
            'query' => Users::getUserauthor($model),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'iduser' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model'=> $model
        ]);
    }
    public function actionEditor()
    {
        $model = new User();
        $dataProvider = new ActiveDataProvider([
            'query' => Users::getUsereditor($model),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'iduser' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model'=> $model
        ]);
    }
    public function actionSubscriber()
    {
        $model = new User();
        $dataProvider = new ActiveDataProvider([
            'query' => Users::getUsersubscriber($model),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'iduser' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model'=> $model
        ]);
    }
    
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Users::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'iduser' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Users model.
     * @param string $id Iduser
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionAccount($id, $filter = null)
    {
        $model = new Article();
        $model->load(Utils::req()->get());
        $latest_article = Article::search($model,$id);
        $top_article = Article::getMostviewedbyuser($id);
        $profilestat = Users::userProfile($id);
        $user =  Users::find()->with('role')->where(['username' => $id])->one();
       
        $bookmarked = Article::find()
        ->innerJoin(['b' => Bookmark::find()->where(['iduser' => User::me()->id])],'b.idarticle=article.idarticle')
        ->orderBy(['b.created_at' => SORT_DESC])->all();
        $liked = Article::find()
        ->innerJoin(['b' => Like::find()->where(['iduser' => User::me()->id,'is_like' => true])],'b.idarticle=article.idarticle')
        ->orderBy(['b.created_at' => SORT_DESC])->all();

        return $this->render('account', [
            'articlemodel' => $model,
            'model' => $user,
            'latest' => $latest_article->all(),
            'top' => $top_article,
            'bookmark' => $bookmarked,
            'liked' => $liked,
            'stat' => $profilestat,
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->iduser]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id Iduser
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->iduser]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id Iduser
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionFollow(){
        $id  = Yii::$app->request->post('id');
        $userId = User::me()->id;

        $like = Follow::find()->where(['user_id' => $userId, 'author_id' => $id])->one();

        if ($like === null) {

            $like = new Follow();

            $like->idfollow = uniqid();
            $like->user_id = $userId;
            $like->author_id = $id;
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
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id Iduser
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::find()->with('role')->where(['username' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
