<?php

namespace tests\codeception\_pages\nerds;

use yii\codeception\BasePage;

/**
 * Represents update password page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class UpdatePasswordPage extends BasePage
{
    public $route = '/update-password';

    /**
     * @param string $oldPassword
     * @param string $password
     * @param string $passwordRepeat
     */
    public function send($oldPassword, $password, $passwordRepeat)
    {
        $this->actor->submitForm('.form-update-password', ['UpdatePasswordForm' => [
            'old_password'      => $oldPassword,
            'password'          => $password,
            'password_repeat'   => $passwordRepeat,
        ]]);
    }
}
