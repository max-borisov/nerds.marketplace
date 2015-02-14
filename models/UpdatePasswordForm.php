<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class UpdatePasswordForm extends Model
{
    public $old_password;
    public $password;
    public $password_repeat;

    private $_user;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['old_password', 'password', 'password_repeat'], 'required'],
            [['old_password'], 'validatePassword'],
            [['password'], 'string', 'min' => 6, 'max' => 100],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (empty($this->_user)) {
            throw new Exception('User object cannot be null');
        }
        if (!Yii::$app->security->validatePassword($this->$attribute, $this->_user->yii_password)) {
            $this->addError($attribute, 'Password is not correct.');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'old_password'      => 'Current password:',
            'password'          => 'New password:',
            'password_repeat'   => 'Confirm password:',
        ];
    }

    public function setUser(User $user)
    {
        $this->_user = $user;
    }
}
