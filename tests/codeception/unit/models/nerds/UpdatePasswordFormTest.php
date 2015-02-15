<?php

namespace tests\codeception\unit\models\nerds;

use app\models\User;
use Yii;
use app\models\UpdatePasswordForm;
use Codeception\Specify;
use yii\codeception\TestCase;
use app\tests\codeception\unit\fixtures\UserFixture;

class UpdatePasswordFormTest extends TestCase
{
    use Specify;

    public function fixtures()
    {
        return [
            'user' => UserFixture::className(),
        ];
    }

    public function testValidation()
    {
        $model = new UpdatePasswordForm();

        $this->specify('validate model with empty attributes', function () use ($model) {
            $model->validate();
            expect('username validation errors' , $model->hasErrors('old_password'))->true();
            expect('email validation errors'    , $model->hasErrors('password'))->true();
            expect('password validation errors' , $model->hasErrors('password_repeat'))->true();
        });

        $this->specify('validate model with no user object passed', function () use ($model) {
            $model->old_password    = 111;
            $model->password        = 111;
            $model->password_repeat = 111;
            $model->validate();
        }, ['throws' => 'yii\base\Exception']);

        $this->specify('validate model password length', function () use ($model) {
            $model->setUser(User::findOne($this->user('max')->id));
            $model->old_password    = '222';
            $model->password        = '333';
            $model->password_repeat = '333';
            $model->validate();
            expect('password is too short', $model->hasErrors('password'))->true();
        });

        $this->specify('validate model with not equal password and password_repeat fields', function () use ($model) {
            $model->setUser(User::findOne($this->user('max')->id));
            $model->old_password    = '222';
            $model->password        = '333333';
            $model->password_repeat = '333222';
            $model->validate();
            expect('password_repeat is not equals password', $model->hasErrors('password'))->true();
        });

        $this->specify('validate model with incorrect old password', function () use ($model) {
            $model->setUser(User::findOne($this->user('max')->id));
            $model->old_password    = '222';
            $model->password        = '333333';
            $model->password_repeat = '333333';
            $model->validate();
            expect('old password is not correct', $model->hasErrors('old_password'))->true();
        });

        $this->specify('validate model with all correct data', function () use ($model) {
            $model->setUser(User::findOne($this->user('max')->id));
            $model->old_password    = '111111';
            $model->password        = '333333';
            $model->password_repeat = '333333';
            $model->validate();
            expect('no validation errors', $model->hasErrors())->false();
        });
    }
}
