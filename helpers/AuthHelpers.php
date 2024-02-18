<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helpers;

use app\models\AuthItem;
use app\models\AuthItemChild;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

class AuthHelpers {

    public static function behaviors() {
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => TRUE,
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        $iduser = self::getIdUser();
                        $req = self::getReq();

                        $module = self::getModule();
                        $controller = self::getController();
                        $action = self::getAction();
                        $route = "$controller/$action";
                        $fullroute = "$module/" . $route;
                        $role = self::getRole();

                        //return TRUE;

                        if ($req->isAjax && strstr($action, 'ajax')) {//untuk filter dan segala function ajax losss
                            return TRUE;
                        }

                        if ($controller == 'download') {//Losss untuk controller 'download'
                            return TRUE;
                        }

                        if ($iduser == 'LMT001' && ($controller == 'rbacrouteassignment' || $controller == 'rbacroutepermission')) {//loss untuk user lmt001 bagian permission
                            return TRUE;
                        }

                        if (Yii::$app->user->can($route) || Yii::$app->user->can($fullroute)) {
                            return TRUE;
                        }
                    }
                ],
                [
                    'allow' => TRUE,
                    'roles' => ['?'],
                    'matchCallback' => function ($rule, $action) {
                        $req = self::getReq();
                        $module = self::getModule();
                        $controller = self::getController();
                        $action = self::getAction();
                        $route = "$controller/$action";
                        $fullroute = "$module/" . $route;
                        $role = self::getRole();

                        if ($req->get('TOKEN')) {
                            $user = User::validateToken($req->get('TOKEN'));
                            if ($user) {
                                Yii::$app->user->login($user);
                                if ($route == 'trsnotif/toroute') {
                                    if (!$req->get('LOGIN')) {
                                        header("Location: " . $req->url . '&LOGIN=TRUE');
                                        die;
                                    }
                                }
                                if (Yii::$app->user->can($route) || Yii::$app->user->can($fullroute)) {
                                    return TRUE;
                                }
                            }
                        }
                    }
                ]
            ]
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['post'],
            ],
        ];
        return $behaviors;
    }

    public static function getModule() {
        return Yii::$app->controller->module->id;
    }

    public static function getController() {
        return Yii::$app->controller->id;
    }

    public static function getAction() {
        return Yii::$app->controller->action->id;
    }

    public static function getRoute() {
        return Yii::$app->requestedRoute;
    }

    public static function getRole() {
        //urutan array setelah setingan default role pada config/web bila ada
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if ($role) {
            $role = isset(array_keys($role)[1]) ? array_keys($role)[1] : array_keys($role)[0];
        }
        return $role;
    }

    public static function getLevelRole() {
        $role = AuthItem::findOne(['name' => self::getRole()]);
        $lvl = 0;
        if ($role) {
            $lvl = $role->flevel;
        }
        return $lvl;
    }

    public static function getIdUser() {
        return Yii::$app->user->getId();
    }

    public static function getReq() {
        return Yii::$app->request;
    }

    public static function isAllowedComponent($route, $component = null) {
        /*
         * los untuk user 'LMT001'
         */
        /*
        if (User::me()->getId() === 'LMT001') {
            return $component ? $component : true;
        }
         * 
         */

        if ((Yii::$app->user->can($route) || Yii::$app->user->can(self::getModule() . '/' . $route))) {
            return $component ? $component : true;
        }
        return FALSE;
    }

    public static function getAccess() {
        $route = self::getRoute();
        $role = self::getRole();
        $attribute = AuthItemChild::findOne(['parent' => $role, 'child' => $route]);
        return $attribute ? unserialize($attribute->attribute) : [];
    }

    public static function AccessByRoute($route) {
        if (Yii::$app->user->can($route)) {
            return TRUE;
        }
        return FALSE;
    }

    public static function getRolename() {
        $drole = AuthItem::find()
                ->where(['type' => 1])
                ->orderBy('flevel')
                ->asArray()
                ->all();

        return $role = ArrayHelper::map($drole, 'name', 'name');
    }

    public static function getRouteAssign($permission) {
        $dassign = AuthItemChild::find()
                ->where(['child' => $permission])
                ->asArray()
                ->all();

        return ArrayHelper::getColumn($dassign, 'parent');
    }

    public static function getFullroute() {
        return self::getModule() . '/' . self::getController() . '/' . self::getAction();
    }

}
