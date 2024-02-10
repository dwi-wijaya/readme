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
use app\models\mstCategory;
use app\models\mstMenu;
use app\models\Notification;
use app\models\User;
use app\models\Users;
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

    public function actionSetting()
    {
        return $this->render('setting');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = '_blank.php';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new AuthForm();
        $model->scenario = AuthForm::SCENARIO_SIGNIN;
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionSignup()
    {
        $this->layout = '_blank.php';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new AuthForm();
        $model->scenario = AuthForm::SCENARIO_SIGNUP;
        if ($this->request->isPost) {
            $user = new User();
            $role = new AuthAssignment();
            if ($model->load($this->request->post()) && $model->validate()) {
                $user->attributes = $model->attributes;
                $user->created_at = date('Y-m-d h:i:s');
                $user->profile_picture = 'user.png';
                $user->password = Yii::$app->security->generatePasswordHash(md5($model->password));
                $role->user_id = $user->username;
                $role->item_name = Utils::ROLE_SUBCRIBER;

                if ($user->save()) {
                    $role->save();
                    return $this->render('login', [
                        'model' => $user,
                    ]);
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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
