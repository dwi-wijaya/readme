<?php

namespace app\controllers;

use app\models\Assets;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Inflector;
use yii\helpers\Json;

/**
 * AssetController implements the CRUD actions for Assets model.
 */
class DashboardController extends LayoutController
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
        
        $data = [];
        $role = Inflector::slug(User::me()->role->item_name,'_');

        return $this->render("_$role", [
            'data' => $data,
        ]);
    }

   
}
