<?php

namespace app\controllers;

use app\helpers\Utils;
use app\models\Notification;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotificationController implements the CRUD actions for Notification model.
 */
class NotificationController extends LayoutController
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
     * Lists all Notification models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Notification::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'idnotification' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMarknotif($id,$route){
        Notification::readNotif($id);
        return $this->redirect([$route]);
    }

    public function actionMarkallnotif(){
        $notif = Notification::findAll(['recipient_id' => User::me()->id]);

        foreach($notif as $n){
            Notification::readNotif($n['idnotification']);
        }
        return $this->redirect(Utils::req()->referrer);
    }

    public function actionNotif(){
        $notif = Notification::find()->where(['recipient_id' => User::me()->id])->orderBy(['created_at' => SORT_DESC]);
        $notif = Utils::createPagination($notif);
        return $this->render('notification', [
            'notif' => $notif['record'],
            'pagination' => $notif['pagination'],
        ]);
    }


    /**
     * Displays a single Notification model.
     * @param string $idnotification Idnotification
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idnotification)
    {
        return $this->render('view', [
            'model' => $this->findModel($idnotification),
        ]);
    }

    /**
     * Creates a new Notification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Notification();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idnotification' => $model->idnotification]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Notification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $idnotification Idnotification
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idnotification)
    {
        $model = $this->findModel($idnotification);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idnotification' => $model->idnotification]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Notification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $idnotification Idnotification
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idnotification)
    {
        $this->findModel($idnotification)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $idnotification Idnotification
     * @return Notification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idnotification)
    {
        if (($model = Notification::findOne(['idnotification' => $idnotification])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
