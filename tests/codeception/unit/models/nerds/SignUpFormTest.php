<?php

namespace tests\codeception\unit\models\nerds;

use Yii;
use app\models\SignUpForm;
use Codeception\Specify;
use yii\codeception\TestCase;
use app\tests\codeception\unit\fixtures\UserFixture;


class SignUpFormTest extends TestCase
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
        $model = new SignUpForm();

        $this->specify('validate model with empty attributes', function () use ($model) {
            expect('name validation errors'         , $model->validate(['name']))->false();
            expect('email validation errors'            , $model->validate(['email']))->false();
            expect('password validation errors'         , $model->validate(['password']))->false();
            expect('password repeat validation errors'  , $model->validate(['password_repeat']))->false();
        });

        $this->specify('name is too short', function() use ($model) {
            $model->name = 'A';
            expect('name validation error', $model->validate(['name']))->false();
        });

        $this->specify('email has incorrect format', function() use ($model) {
            $model->email = 'abk.ru';
            expect('email validation error', $model->validate(['email']))->false();
        });

        $this->specify('password is too short', function() use ($model) {
            $model->password = '111';
            expect('password validation error', $model->validate(['password']))->false();
        });

        $this->specify('password and password_repeat are not match', function() use ($model) {
            $model->password = '111111';
            $model->password_repeat = '11111';
            expect('password confirm validation error', $model->validate(['password']))->false();
        });

        $this->specify('set name that already in use', function() use ($model) {
            $model->name = $this->user('max')->name;
            $model->email = 'a@bk.ru';
            $model->password = '111111';
            $model->password_repeat = '111111';
            expect('name validation error', $model->validate())->false();
        });

        $this->specify('set email that already in use', function() use ($model) {
            $model->name = 'Max test';
            $model->email = $this->user('max')->email;
            $model->password = '111111';
            $model->password_repeat = '111111';
            expect('email validation error', $model->validate())->false();
        });

        $this->specify('set correct attributes', function() use ($model) {
            $model->name = 'Max Test';
            $model->email = 'abctest@bk.ru';
            $model->password = '111111';
            $model->password_repeat = '111111';
            expect('validation success', $model->validate())->true();
        });
    }
}
