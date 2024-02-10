<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class AuthForm extends Model
{
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $email;
    public $confirmPassword;
    public $rememberMe = true;

    const SCENARIO_SIGNIN = 'SIGN-IN';
    const SCENARIO_SIGNUP = 'SIGN-UP';

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required', 'on' => self::SCENARIO_SIGNIN],
            [['username', 'password', 'first_name', 'email', 'confirmPassword'], 'required', 'on' => self::SCENARIO_SIGNUP],
            [['username'], 'unique', 'on' => self::SCENARIO_SIGNUP, 'targetClass' => '\app\models\User', 'targetAttribute' => 'username', 'message' => 'This username has already been taken.'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
            // [['password', 'confirmPassword'], 'string', 'min' => 8],
            ['email', 'email'],
            ['username', 'string', 'min' => 3, 'max' => 255],
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_]+$/i', 'message' => 'Username can only contain letters, numbers, and underscores.'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }


    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password, $user->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
