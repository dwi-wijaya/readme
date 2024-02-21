<?php

namespace app\models;

use app\helpers\Utils;
use Yii;

class User extends Users  implements \yii\web\IdentityInterface

{

    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'password', 'bio', 'authKey'], 'string'],
            [['created_at', 'updated_at', 'lastlogin'], 'safe'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.']
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'password' => 'Password',
            'bio' => 'Bio',
            'email' => 'Email',
            'authKey' => 'Auth Key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'lastlogin' => 'Lastlogin',
        ];
    }


    /**
     * {@inheritdoc}
     */




    public static function me()
    {
        return \Yii::$app->user->identity;
    }

    public static function findIdentity($id)
    {
        return static::findOne(['username' => $id,]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);


        return null;
    }

    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->username;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password, $hash)
    {
        return Yii::$app->getSecurity()->validatePassword(md5($password), $hash);
    }

    public static function getProfile()
    {
        $user = Yii::$app->user->identity;
        $route = Yii::$app->user->isGuest ?  'auth/sign-in' : 'users/account?id=' . $user->username;
        // check if the user is a guest or not
        if (Yii::$app->user->isGuest || empty($user->profile_picture)) {
            // use the default image
            $img = Utils::baseUploadsStock('user.png');
        } else {
            // use the user's profile picture
            $img = Utils::baseUploadsProfile($user->profile_picture);
        }
        return ['route' => $route, 'img' => $img];
    }
}
