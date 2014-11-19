<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class SignUpForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'password_repeat'], 'required'],
            [['username'], 'string', 'min' => 2],
            ['email', 'email'],
            [['password'], 'string', 'min' => 5],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    /*public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }*/

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    /*public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        } else {
            return false;
        }
    }*/

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    /*public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }*/

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username'          => 'Name:',
            'email'             => 'Email:',
            'password'          => 'Password:',
            'password_repeat'   => 'Confirm password:',
        ];
    }

    public function afterValidate()
    {
        if (!$this->hasErrors()) {



            $this->addError('email', 'Error');
        }

        parent::afterValidate();
    }
}
