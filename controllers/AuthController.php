<?php

namespace app\controllers;

use app\models\AuthAssignment;
use yii\filters\AccessControl;
use app\models\SecurityToken;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\AuthForm;
use app\models\OtpCodes;
use app\helpers\Utils;
use yii\web\Response;
use app\models\User;
use Yii;


class AuthController extends LayoutController
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
     * Login action.
     *
     * @return Response|string
     */
    public function actionSignIn()
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
        return $this->render('sign-in', [
            'model' => $model,
        ]);
    }
    public function actionResendOtp($userId, $userEmail)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        // Temukan pengguna berdasarkan ID
        $user = User::findOne($userId);

        if (!$user) {
            Yii::$app->session->setFlash('error', 'User not found.');
            return $this->goBack();
        }

        // Generate new OTP
        $otp = mt_rand(100000, 999999); // Generate random 6-digit OTP

        // Save OTP to database
        $otpCode = OtpCodes::saveOtpCode($userId, $otp);
        $emailSent = Utils::sendEmailOtp($userEmail, $otp);


        Utils::flashSuccess('OTP has been resent to your email.');

        return ['success' => true];
    }
    public function actionConfirmOtp($userId, $userEmail)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = '_blank.php';
        $model = new AuthForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Validate OTP
            $otp = $model->otp;

            $otpRecord = OtpCodes::findOtpCode($userId, $otp);

            if ($otpRecord) {
                // Generate token for reset password
                $resetPasswordToken = Yii::$app->security->generateRandomString(32);

                // Save token to database
                $tokenModel = SecurityToken::createToken($userId, $resetPasswordToken);

                return $this->redirect(['reset-password', 'token' => $resetPasswordToken]);
            } else {
                // OTP is invalid or expired
                Yii::$app->session->setFlash('error', 'Invalid or expired OTP. Please try again.');
            }
        }
        return $this->render('_confirm_otp', [
            'model' => $model,
            'userId' => $userId,
            'userEmail' => $userEmail
        ]);
    }
    public function actionVerifyEmail($token, $isAuthorized = false)
    {
        $this->layout = '_blank.php';

        $tokenModel = SecurityToken::findByToken($token);

        if (!$tokenModel || $tokenModel->isExpired() || $tokenModel->isUsed()) {
            Yii::$app->session->setFlash('error', 'Invalid or expired token.');
            return $this->render('_invalid_token');
        }
        $tokenModel->markAsUsed();
        return $this->render('_confirm_email', [
            'user' => User::findOne(['username' => $tokenModel->user_id]),
            'isAuthorized' => $isAuthorized,
        ]);
    }
    public function actionResetPassword($token, $isAuthorized = false)
    {
        $this->layout = '_blank.php';

        $tokenModel = SecurityToken::findByToken($token);

        if (!$tokenModel || $tokenModel->isExpired() || $tokenModel->isUsed()) {
            Yii::$app->session->setFlash('error', 'Invalid or expired token.');
            return $this->render('_invalid_token');
        }

        $model = new AuthForm();
        $model->scenario = AuthForm::SCENARIO_RESET_PASSWORD;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Lakukan proses reset password
            $user = User::findOne(['username' => $tokenModel->user_id]);
            $user->password = Yii::$app->security->generatePasswordHash(md5($model->newPassword));

            if ($user->save()) {
                // Tandai token sebagai digunakan
                $tokenModel->markAsUsed();

                if (!$isAuthorized) {
                    Utils::flashSuccess('Password has been reset successfully.');
                    return $this->redirect(['auth/sign-in']);
                } else {
                    Utils::flashSuccessSweetAlert('Password has been reset successfully.');
                    return $this->redirect('users/forgot-password');
                }
            } else {
                Utils::flashFailed('Failed to reset password.');
            }
        }

        return $this->render('_reset_password', [
            'model' => $model,
            'isAuthorized' => $isAuthorized,
        ]);
    }
    public function actionForgotPassword()
    {
        $this->layout = '_blank.php';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new AuthForm();
        $model->scenario = AuthForm::SCENARIO_FORGOT_PASSWORD;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $otpCode = mt_rand(100000, 999999); // Generate a random 6-digit OTP code

            // Save OTP code to database
            $otpRecord = OtpCodes::saveOtpCode($model->username, $otpCode);

            // Send OTP code to user's email
            $emailSent = Utils::sendEmailOtp($model->email, $otpCode);

            if ($emailSent) {
                Utils::flashSuccess('Email successfully sent. Please check your inbox.');
                // Redirect to OTP confirmation page
                return $this->redirect(['confirm-otp', 'userId' => $model->username, 'userEmail' => $model->email]);
            } else {
                Utils::flashFailed('Failed to send email. Please try again later.');
            }
            Utils::flashFailed('Email successfully sent. Please check your inbox.');
            return $this->redirect('confirm-otp');
        }
        return $this->render('forgot-password', [
            'model' => $model
        ]);
    }
    public function actionSignUp()
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
                    return $this->render('sign-in', [
                        'model' => $user,
                    ]);
                }
            }
        }

        return $this->render('sign-up', [
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
}
