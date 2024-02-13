<?php

namespace app\controllers;

use app\helpers\Utils;
use app\models\GuideList;
use app\models\Guides;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GuideController implements the CRUD actions for Guides model.
 */
class GuideController extends LayoutController
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
     * Lists all Guides models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Guides::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'idguide' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Guides model.
     * @param string $idguide Idguide
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => GuideList::find()->where(['idguide' => $id])->orderBy(['order' => SORT_ASC]),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionAddList()
    {
        $model = new GuideList();
        if ($this->request->isPost && $model->load(Yii::$app->request->post()) ) {
            $model->idguide_list = uniqid();
            $model->created_at = date('Y-m-d H:i:s');
            $model->save() ? Utils::flashSuccess('Success Add Article List') :  Utils::flashFailed('Failed Add Article List');
            return  $this->redirect(['view', 'id' => $model->idguide]);
        }
        if (Utils::req()->isAjax) {
            $req = Yii::$app->request;
            $data = $req->post('data');
            $guideId = isset($data) ? $data['id'] : NULL;
            $authorId = isset($data) ? $data['author'] : NULL;

            $model->idguide = $guideId;

            return $this->renderAjax('_formList', [
                'model' => $model,
                'authorId' => $authorId,
                'urlFrom' => 'add'
            ]);
        }
        
    }
    public function actionUpdateList($id = null)
    {

        
        $req = Yii::$app->request;
        $data = $req->post('data');
        $listId = isset($data) ? $data['idlist'] : $id;
        $model = GuideList::findOne($listId);
        if (Utils::req()->isAjax) {
            $authorId = isset($data) ? $data['author'] : NULL;
            // echo '<pre>';print_r($model);die;
            return $this->renderAjax('_formList', [
                'model' => $model,
                'authorId' => $authorId,
                'urlFrom' => 'update'
            ]);
        }
        if ($model->load(Utils::req()->post()) ) {
            $model->save() ? Utils::flashSuccess('Success Update Article List') :  Utils::flashFailed('Failed Update Article List');
            return  $this->redirect(['view', 'id' => $model->idguide]);
        }
        
    }
    /**
     * Creates a new Guides model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Guides();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->saveGuide();
                return $this->redirect(['view', 'id' => $model->idguide]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Guides model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $idguide Idguide
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idguide]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Guides model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $idguide Idguide
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Guides model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $idguide Idguide
     * @return Guides the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Guides::findOne(['idguide' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
