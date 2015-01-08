<?php

namespace tests\codeception\unit\models\nerds;

use Yii;
use app\components\HelperUser;
use app\models\SignInForm;
use Codeception\Specify;
use yii\codeception\TestCase;
use app\tests\codeception\unit\fixtures\PhpbbUserFixture;


class SignInFormTest extends TestCase
{
    use Specify;

    public function fixtures()
    {
        return [
            'user' => PhpbbUserFixture::className(),
        ];
    }

    public function testValidation()
    {
        $model = new SignInForm();

        $this->specify('validate model with empty attributes', function () use ($model) {
            expect('email validation errors'            , $model->validate(['email']))->false();
            expect('password validation errors'         , $model->validate(['password']))->false();
        });

        $this->specify('email has incorrect format', function() use ($model) {
            $model->email = 'abk.ru';
            expect('email validation error', $model->validate(['email']))->false();
        });

        $this->specify('set correct email and incorrect password', function() use ($model) {
            $model->email = $this->user('max')->user_email;
            $model->password = 'asde';
            expect('validate password error', $model->validate())->false();
        });

        $this->specify('set correct email and password. User account is activated.', function() use ($model) {
            $model->email = $this->user('max')->user_email;
            $model->password = '111111';
            expect('validation success', $model->validate())->true();
        });

        $this->specify('set correct email and password. User account is not activated.', function() {
            $model = new SignInForm();
            $model->email = $this->user('not_confirmed_account')->user_email;
            $model->password = '111111';
            expect('signin error', $model->validate())->false();
        });
    }

    public function testLogin()
    {
        $this->specify('user is Guest', function() {
            expect('user is guest', HelperUser::isGuest())->true();
        });

        $this->specify('login user by email and password', function() {
            $model = new SignInForm();
            $model->email = $this->user('max')->user_email;
            $model->password = '111111';
            expect('login success', $model->login())->true();
        });

        $this->specify('user is not Guest', function() {
            expect('user is not guest', HelperUser::isGuest())->false();
        });
    }
}
