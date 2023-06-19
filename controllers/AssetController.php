<?php

namespace app\controllers;

use app\models\Assets;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * AssetController implements the CRUD actions for Assets model.
 */
class AssetController extends LayoutController
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
     * Lists all Assets models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Assets::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'idasset' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Assets model.
     * @param string $id Idasset
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Assets model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Assets();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model) {
                    Assets::saveAssets($model);
                    return $this->goBack();
                }
            }
        }
    }

    /**
     * Updates an existing Assets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id Idasset
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model) {
                Assets::saveAssets($model);
                return $this->refresh();
            }
        }
    }

    public function actionFilter()
    {
        $filterValue = Yii::$app->request->post('filterValue');
        $filteredData = Assets::find()->andFilterWhere(['like', 'asset_name', $filterValue])->all(); // function to apply the filter
        return Json::encode($filteredData);
    }

    /**
     * Deletes an existing Assets model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id Idasset
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = Assets::findOne($id);
        if (is_file('./uploads/assets/' . $model->asset_name)) {
            unlink('./uploads/assets/' . $model->asset_name);
            $model->delete();
        }
        return $this->redirect(['/site/assets']);
    }

    /**
     * Finds the Assets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id Idasset
     * @return Assets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Assets::findOne(['idasset' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
