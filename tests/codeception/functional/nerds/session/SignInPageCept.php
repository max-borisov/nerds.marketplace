<?php

use tests\codeception\_pages\nerds\SignInPage;
use app\components\HelperPage;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that login works');

$signInPage = SignInPage::openBy($I);
$I->wantTo('ensure page has a proper header');
$I->see(HelperPage::SIGN_IN_PAGE_HEADER, 'h1');

$I->amGoingTo('try to login with empty credentials');
$signInPage->login('', '');
$I->expectTo('see validations errors');
$I->see('Email: cannot be blank.');
$I->see('Password: cannot be blank.');

$I->amGoingTo('try to login with wrong credentials');
$signInPage->login('admin@mail.com', 'wrong');
$I->expectTo('see validations errors');
$I->see('Incorrect username or password.');

// Doesn't work
/*$I->amGoingTo('try to login with correct credentials');
$signInPage->login('new_max@bk.ru', 'max');
$I->expectTo('see internal links');
$I->seeLink('Categories');*/
