<?php

use tests\codeception\_pages\nerds\SignInPage;
use tests\commons\TestCommons;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that login works');

$loginPage = SignInPage::openBy($I);
$I->wantTo('ensure page has a proper header');
$I->see(TestCommons::SIGN_IN_PAGE_HEADER, 'h2');

$I->amGoingTo('try to login with empty credentials');
$loginPage->login('', '');
$I->expectTo('see validations errors');
$I->see('Email: cannot be blank.');
$I->see('Password: cannot be blank.');

$I->amGoingTo('try to login with wrong credentials');
$loginPage->login('admin@mail.com', 'wrong');
$I->expectTo('see validations errors');
$I->see('Incorrect username or password.');

// Doesn't work
$I->amGoingTo('try to login with correct credentials');
$loginPage->login('new_max@bk.ru', 'max');
$I->expectTo('see internal links');
$I->seeLink('Categories');
