<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\components\HelperBase;

/**
 * LoginForm is the model behind the login form.
 */
class SignInForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = false;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUserByEmail();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email'             => 'Email:',
            'password'          => 'Password:',
        ];
    }

    public function login()
    {
        return Yii::$app->user->login($this->getUserByEmail());
    }

    /**
     * Finds user by [[email]]
     *
     * @return PhpbbUser|null
     */
    private function getUserByEmail()
    {
        if ($this->_user === false) {
            $this->_user = PhpbbUsers::findByEmail($this->email);
        }
        return $this->_user;
    }
}