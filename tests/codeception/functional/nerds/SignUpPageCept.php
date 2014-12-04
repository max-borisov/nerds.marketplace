<?php

use tests\codeception\_pages\nerds\SignUpPage;
use tests\common\TestCommon;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that sign up page  works');

$loginPage = SignUpPage::openBy($I);
$I->wantTo('ensure page has a proper header');
$I->see(TestCommon::SIGN_UP_PAGE_HEADER, 'h2');

$I->amGoingTo('fill form with empty data');
$loginPage->login('', '', '', '');
$I->expectTo('see validations errors');
$I->see('Name: cannot be blank.');
$I->see('Email: cannot be blank.');
$I->see('Password: cannot be blank.');
$I->see('Confirm password: cannot be blank.');

$I->amGoingTo('set name which has been already taken');
$loginPage->login('max', 'new_max_new@bk.ru', '111111', '111111');
$I->expectTo('see validations errors');
$I->see('This user name has already been taken.');

$I->amGoingTo('set email which has been already taken');
$loginPage->login('MaxMax', 'new_max@bk.ru', '111111', '111111');
$I->expectTo('see validations errors');
$I->see('this email address has already been registered to the system.');

$I->amGoingTo('set confirmation password which differs from original password');
$loginPage->login('MaxMax', 'new_max_new@bk.ru', '111111', '111122');
$I->expectTo('see validations errors');
$I->see('Password: must be repeated exactly.');

$time = time();
$I->amGoingTo('set correct data');
$loginPage->login('Max_' . $time , 'new_max_' . $time . '@bk.ru', '111111', '111111');

$I->expectTo('see success message');
$I->see('Your account has been registered');
$I->seeCurrentUrlEquals('/signin');
