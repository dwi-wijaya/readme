<?php

namespace app\controllers;

use app\models\mstReason;
use Egulias\EmailValidator\Result\Reason\Reason;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ReasonController implements the CRUD actions for mstReason model.
 */
class ReasonController extends LayoutController
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
     * Lists all mstReason models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => mstReason::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'idreason' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAjaxListreason()
    {
        header('Content-Type: application/json');
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $statuss = $_POST['depdrop_parents'];
            if ($statuss != null) {
                $data = mstReason::find()->where(['status' => $statuss])->asArray()->all();
                $selected = '';
                foreach ($data as $key => $value) {
                    $out[] = ['id' => $value['idreason'], 'name' => $value['reason']];
                }
                return ['output' => $out, 'selected' => $selected];
                die;
            }
        }
        return ['output' => '', 'selected' => ''];
        die;
    }

    /**
     * Displays a single mstReason model.
     * @param string $idreason Idreason
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idreason)
    {
        return $this->render('view', [
            'model' => $this->findModel($idreason),
        ]);
    }

    /**
     * Creates a new mstReason model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new mstReason();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idreason' => $model->idreason]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing mstReason model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $idreason Idreason
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idreason)
    {
        $model = $this->findModel($idreason);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idreason' => $model->idreason]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing mstReason model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $idreason Idreason
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idreason)
    {
        $this->findModel($idreason)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the mstReason model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $idreason Idreason
     * @return mstReason the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idreason)
    {
        if (($model = mstReason::findOne(['idreason' => $idreason])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
