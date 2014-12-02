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
        $this->actor->fillField('input[name="SignUpForm[username]"]', $name);
        $this->actor->fillField('input[name="SignUpForm[email]"]', $email);
        $this->actor->fillField('input[name="SignUpForm[password]"]', $password);
        $this->actor->fillField('input[name="SignUpForm[password_repeat]"]', $passwordRepeat);
        $this->actor->click('input[type="submit"]');
    }
}
