<?php

namespace tests\codeception\_pages\nerds;

use yii\codeception\BasePage;

/**
 * Represents signup page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class SignUpPage extends BasePage
{
    public $route = '/signup';

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $passwordRepeat
     */
    public function login($name, $email, $password, $passwordRepeat)
    {
        $this->actor->submitForm('.form-signup', ['SignUpForm' => [
            'username'          => $name,
            'email'             => $email,
            'password'          => $password,
            'password_repeat'   => $passwordRepeat,
        ]]);
    }
}
