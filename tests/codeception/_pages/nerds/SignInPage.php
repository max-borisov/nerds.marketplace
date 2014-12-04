<?php

namespace tests\codeception\_pages\nerds;

use yii\codeception\BasePage;

/**
 * Represents signin page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class SignInPage extends BasePage
{
    public $route = '/signin';

    /**
     * @param string $email
     * @param string $password
     */
    public function login($email, $password)
    {
        $this->actor->submitForm('.form-signin', ['SignInForm' => [
            'email'     => $email,
            'password'  => $password,
        ]]);
    }
}
