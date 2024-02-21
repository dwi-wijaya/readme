<?php

namespace app\controllers;

use app\helpers\Utils;
use app\models\Article;
use app\models\Assets;
use app\models\AuthAssignment;
use app\models\AuthForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Follow;
use app\models\Guides;
use app\models\mstCategory;
use app\models\mstMenu;
use app\models\Notification;
use app\models\OtpCodes;
use app\models\SecurityToken;
use app\models\Trending;
use app\models\User;
use app\models\UserProgress;
use app\models\Users;
use PharIo\Manifest\Author;
use yidas\widgets\Pagination;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class SiteController extends LayoutController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Article();
        $model->load(Utils::req()->get());
        $mviewed = Article::getMostViewed();

        // echo '<pre>';print_r(mstMenu::getNavbarLTE());die;

        $latest = Article::search($model);
        $data = Utils::createPagination($latest);

        return $this->render('index', [
            'top' => $mviewed,
            'latest' => $data['record'],
            'pagination' => $data['pagination'],
            'model' => $model
        ]);
    }

    public function actionSaveProgressGuide()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $idguideList = Utils::req()->post('list_id');
        $idguide = Utils::req()->post('guide_id');

        $me = User::me();
        $success = true; // Ganti dengan logika sesuai dengan kebutuhan Anda
        $model = UserProgress::findOne(['user_id' => $me->username, 'idguide_list' => $idguideList]) ?: new UserProgress();
        if ($model->isNewRecord) {
            $model->iduser_progress = uniqid();
            $model->user_id = $me->username;
            $model->created_at = date('Y-m-d H:i:s');
            $model->idguide = $idguide;
            $model->idguide_list = $idguideList;
            if (!$model->save()) {
                $success = false;
            }
        } else {
            if (!$model->delete()) {
                $success = false;
            }
        }

        return ['success' => $success];
    }
    public function actionGuide($slug = null)
    {
        $model = new Guides();

        $guides  = Guides::find()->with('list')->andFilterWhere(['slug' => $slug]);
        $data = Utils::createPagination($guides);
        if ($slug) {
            $guides = $guides->one();
            $marks = [];
            if (!Yii::$app->user->isGuest) {
                $marks = UserProgress::find()->select('idguide_list')
                    ->where(['idguide' => $guides->idguide, 'user_id' => User::me()->username])
                    ->indexBy('idguide_list')
                    ->asArray()->all();;
            }
            Trending::saveTransaction($guides, Trending::TYPE_GUIDE);
            return $this->render('_guidelist', [
                'guides' => $guides,
                'marks' => $marks
            ]);
        } else {
            $popular = Trending::getPopularGuide();
            return $this->render('guides', [
                'guides' => $data['record'],
                'popular' => $popular,
                'pagination' => $data['pagination'],
            ]);
        }
    }
    public function actionFollowing()
    {
        $model = new Article();
        $followed = Article::getFollowing();

        $data = Utils::createPagination($followed);
        return $this->render('following', [
            'following' => $data['record'],
            'pagination' => $data['pagination'],
            'model' => $model
        ]);
    }

    public function actionExplore($idcat = null)
    {
        $model = new Article();
        $model->load(Utils::req()->get());
        $article = Article::search($model, $idcat);
        $cat = mstCategory::find()->all();
        $data = Utils::createPagination($article);

        return $this->render('explore', [
            'article' => $data['record'],
            'pagination' => $data['pagination'],
            'cat' => $cat,
            'idcat' => $idcat,
            'model' => $model
        ]);
    }

    public function actionFiltercat()
    {
        $filterValue = Yii::$app->request->post('idcat');
        $idcat = $filterValue;
        $article = Article::findbyCat($idcat);

        return json_encode($article);
    }

    public function actionCategory($idcat = null)
    {

        $article_count = Article::countbyCat();
        $cat = mstCategory::getCategory($idcat);
        $article = [];
        if ($idcat) {
            $article = Article::find()->where(['idcat' => $idcat]);
            $data = Utils::createPagination($article);
            return $this->render('category', [
                'article' => $data['record'],
                'pagination' => $data['pagination'],
                'catname' => $cat->one()['name'],
                'cat' => $cat->all(),
                'total' => $data['total'],
            ]);
        }
        return $this->render('category', [
            'cat' => $cat->all(),
            'article' => $article,
            'catname' => $cat->one()['name'],

        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
