<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class SignUpForm extends Model
{
    public $name;
    public $email;
    public $password;
    public $password_repeat;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'password_repeat'], 'required'],
            [['name'], 'string', 'min' => 2],
            ['email', 'email'],
            [['password'], 'string', 'min' => 6, 'max' => 100],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'              => 'Name:',
            'email'             => 'Email:',
            'password'          => 'Password:',
            'password_repeat'   => 'Confirm password:',
        ];
    }

    public function afterValidate()
    {
        // Check email and name to be unique
        if (!$this->hasErrors()) {
            if (User::find()->where('name = :name', [':name' => strtolower($this->name)])->exists()) {
                $this->addError('name', 'This user name has already been taken.');

            } else if (User::find()->where('email = :email', [':email' => $this->email])->exists()) {
                $this->addError('email', 'This email address has already been registered to the system.');
            }
        }
        parent::afterValidate();
    }
}
