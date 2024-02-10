<?php

namespace app\helpers;

use app\models\Article;
use app\models\AuthAssignment;
use app\models\AuthItem;
use app\models\Notification;
use app\models\User;
use DateTime;
use dominus77\sweetalert2\Alert;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yii;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class Utils
{

    // User Role
    const ROLE_GUEST  = 0;
    const ROLE_ADMIN  = 'SUPER ADMIN';
    const ROLE_AUTHOR = 'AUTHOR';
    const ROLE_EDITOR = 'EDITOR';
    const ROLE_SUBCRIBER = 'SUBSCRIBER';

    // Article Status
    const STAT_REVISION  = -1;
    const STAT_REJECT    = -2;
    const STAT_DRAFT     = 0;
    const STAT_DONE      = 1;
    const STAT_IN_REVIEW = 2;
    const STAT_APPROVED  = 3;

    // Utils variable
    const DIR = DIRECTORY_SEPARATOR;

    // Reason Flag
    const FLAG_REJECT = 'REJECT';
    const FLAG_REVISION = 'REVISION';
    const FLAG_OTHERS = 'OTHERS';

    // Notif
    const NOTIF_ARTICLE_REJECTED = -2;
    const NOTIF_ARTICLE_REVISION = -1;
    const NOTIF_ARTICLE_INREVIEW = 2;
    const NOTIF_ARTICLE_APPROVED = 3;
    const NOTIF_ARTICLE_BOOKMARK = 5;
    const NOTIF_ARTICLE_LIKE = 4;
    const NOTIF_ARTICLE_VIEW = 6;
    const NOTIF_NEW_FOLLOWER = 7;
    const NOTIF_SUBSCRIBE = 8;
    const NOTIF_OTHERS = 1;
    const STATUS_READ = 1;

    public static function headerSection($title = null)
    {
        return "<div class='row text-center mb-4'>
            <div class='col'>
                <hr>
            </div>
            <div class='col-6 col-md-4 col-lg-3'>
                <div class='header-section center-y'>
                    <p class=' m-0'>$title</p>
                </div>
            </div>
            <div class='col'>
                <hr>
            </div>
        </div>";
    }

    public static function req()
    {
        return Yii::$app->request;
    }



    public static function baseUrl()
    {
        return Yii::$app->request->getBaseUrl();
    }

    public static function baseUploadsThumbnail($file = null)
    {
        $thumbnail_img = Url::base(TRUE) . self::DIR . 'uploads' . self::DIR . 'article' . self::DIR . 'thumbnail' . self::DIR . $file;
        $stock_img = self::baseUploadsStock('no-photo-available.png');
        $img = $file == null ? $stock_img : $thumbnail_img;
        return  $img;
    }
    public static function baseUploadsProfile($file = null)
    {
        return Url::base(TRUE) . self::DIR . 'uploads' . self::DIR . 'users' . self::DIR . 'profile' . self::DIR . $file;
    }
    public static function baseUploadsAssets($file = null)
    {
        return Url::base(TRUE) . self::DIR . 'uploads' . self::DIR . 'assets' . self::DIR . $file;
    }

    public static function baseUploadsStock($file = null)
    {
        return Url::base(TRUE) . self::DIR . 'img' . self::DIR . $file;
    }

    public static function createDirectory($path)
    { // "/img/signature/"
        if ($path && !is_dir('.' . $path)) {
            mkdir('.' . $path, 0777, true);
            return true;
        }
        return false;
    }
    public static function getLabelRolename()
    {
        $me = AuthAssignment::find()->where(['user_id' => User::me()->id])->one()->item_name;

        return $me;
    }
    public static function flashSuccess($description = 'Berhasil.')
    {
        return Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, [
            [
                'title' => 'Success!',
                'text' => $description,
            ]
        ]);
    }

    public static function flashWarning($description = 'Warning.')
    {
        return Yii::$app->session->setFlash(Alert::TYPE_WARNING, [
            [
                'title' => 'Warning!',
                'text' => $description,
            ]
        ]);
    }

    public static function flashFailed($description = 'Error.')
    {
        return Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
            [
                'title' => 'Error!',
                'text' => $description,
            ]
        ]);
    }

    public static function flashInfo($description = 'Info.')
    {
        return Yii::$app->session->setFlash(Alert::TYPE_INFO, [
            [
                'title' => 'Info!',
                'text' => $description,
            ]
        ]);
    }
    public static function getStatus($stat)
    {
        $status = [
            self::STAT_DRAFT => 'btn-primary',
            self::STAT_DONE => 'btn-secondary',
            self::STAT_IN_REVIEW => 'btn-orange',
            self::STAT_APPROVED => 'btn-success',
            self::STAT_REVISION => 'btn-warning',
            self::STAT_REJECT => 'btn-danger',
        ];
        $statname = [
            self::STAT_DRAFT => 'DRAFT',
            self::STAT_DONE => 'PENDING',
            self::STAT_IN_REVIEW => 'IN REVIEW',
            self::STAT_APPROVED => 'APPROVED',
            self::STAT_REVISION => 'REVISION',
            self::STAT_REJECT => 'REJECT',
        ];
        $class = isset($status[$stat]) ? $status[$stat] : 'btn-default';

        return Html::button($statname[$stat], ['class' => 'btn-xs btn b-5 ' . $class]);
    }

    public static function getFlag($stat)
    {
        $status = [
            self::FLAG_REJECT => 'btn-outline-warning',
            self::FLAG_REVISION => 'btn-outline-danger',
            self::FLAG_OTHERS => 'btn-outline-secondary',
        ];
        $statname = [
            self::FLAG_REJECT => 'REVISION',
            self::FLAG_REVISION => 'REJECT',
            self::FLAG_OTHERS => 'OTHERS',
        ];
        $class = isset($status[$stat]) ? $status[$stat] : 'btn-default';

        return Html::button($statname[$stat], ['class' => 'btn-xs btn b-5 ' . $class]);
    }
    public static function fa($name, $bg = null)
    {
        return Html::tag('i', null, ['class' => "cat-icon fa p-2 fa-$name", 'style' => "background-color:$bg"]);
    }

    public static function createPagination($data)
    {
        $total = count($data->all());

        // Initialize a Data Pagination
        $pagination = new \yidas\data\Pagination([
            'totalCount' => $total,
            'pergpage' => 6,
        ]);
        $records = $data
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return [
            'record' => $records,
            'total' => $total,
            'pagination' =>  $pagination
        ];
    }
    public static function getID()
    {
        return (string) round(microtime(true) * 1000);
    }

    public static function getNotificon($type)
    {
        $icon = [
            self::NOTIF_ARTICLE_APPROVED => 'check',
            self::NOTIF_ARTICLE_REJECTED => 'ban',
            self::NOTIF_ARTICLE_REVISION => 'pen',
            self::NOTIF_ARTICLE_LIKE => 'thumbs-up',
            self::NOTIF_ARTICLE_BOOKMARK => 'bookmark',
            self::NOTIF_ARTICLE_VIEW => 'eye',
            self::NOTIF_NEW_FOLLOWER => 'user-plus',
            self::NOTIF_SUBSCRIBE => 'bell',
            self::NOTIF_OTHERS => 'bell',
        ];
        return $icon[$type] ? $icon[$type] : 'bell';
    }
    public static function getNotiftext($type = null,$idarticle = null)
    {
        $article = Article::find()->where(['idarticle' => $idarticle])->one();

        $text = [
            self::NOTIF_ARTICLE_APPROVED => '[Approved] - ' . $article->title . ' ! ',
            self::NOTIF_ARTICLE_REJECTED => '[Rejected] - ' . $article->title . ' ! ',
            self::NOTIF_ARTICLE_REVISION => '[Revision] - ' . $article->title . ' ! ',
            self::NOTIF_ARTICLE_LIKE => 'Your Article Like',
            self::NOTIF_ARTICLE_BOOKMARK => 'bookmark',
            self::NOTIF_ARTICLE_VIEW => 'eye',
            self::NOTIF_NEW_FOLLOWER => 'user-plus',
            self::NOTIF_SUBSCRIBE => 'bell',
            self::NOTIF_OTHERS => 'bell',
        ];
        return $text[$type] ? $text[$type] : 'Notification !';
    }

    public static function sendNotif($sender = null, $recipient = null, $type = null,  $idarticle = null, $icon = null)
    {

        $notif = new Notification();
        $notif->idnotification = self::getID();
        $notif->recipient_id = $recipient;
        $notif->created_at = date('Y-m-d h:i:s');
        $notif->idarticle = $idarticle;
        $notif->sender_id = $sender;
        $notif->type = $type;
        $notif->icon = $icon;
        $notif->text = self::getNotiftext($type,$idarticle);
        $notif->save();
    }

    public static function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime();
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
