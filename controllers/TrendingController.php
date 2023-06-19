<?php

namespace app\controllers;

use app\models\Trending;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrendingController implements the CRUD actions for Trending model.
 */
class TrendingController extends LayoutController
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
     * Lists all Trending models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Trending::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'idtrend' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Trending model.
     * @param string $idtrend Idtrend
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idtrend)
    {
        return $this->render('view', [
            'model' => $this->findModel($idtrend),
        ]);
    }

    /**
     * Creates a new Trending model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Trending();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idtrend' => $model->idtrend]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Trending model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $idtrend Idtrend
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idtrend)
    {
        $model = $this->findModel($idtrend);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idtrend' => $model->idtrend]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Trending model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $idtrend Idtrend
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idtrend)
    {
        $this->findModel($idtrend)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Trending model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $idtrend Idtrend
     * @return Trending the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idtrend)
    {
        if (($model = Trending::findOne(['idtrend' => $idtrend])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
