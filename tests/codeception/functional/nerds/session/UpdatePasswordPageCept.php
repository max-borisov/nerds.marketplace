<?php

use tests\codeception\_pages\nerds\UpdatePasswordPage;
use app\components\HelperPage;
use tests\common\TestCommon;

$scenario->group('all');
$I = new FunctionalTester($scenario);
$I->wantTo('ensure that update password page works');

TestCommon::logMeIn($I);

$page = UpdatePasswordPage::openBy($I);
$I->wantTo('ensure page has a proper header');
$I->see(HelperPage::UPDATE_PASSWORD_PAGE_HEADER, 'h1');

$I->amGoingTo('fill form with empty data');
$page->send('', '', '');
$I->expectTo('see validations errors');
$I->seeElement('.error-summary');

$I->amGoingTo('fill form with new password which is too short');
$page->send('111', '222', '333');
$I->expectTo('see validations errors');
$I->seeElement('.error-summary');

$I->amGoingTo('fill form with password and password repeat which are not the same');
$page->send('111', '222222', '333333');
$I->expectTo('see validations errors');
$I->seeElement('.error-summary');

$I->amGoingTo('fill form with incorrect old password');
$page->send('111', '222222', '222222');
$I->expectTo('see validations errors');
$I->seeElement('.error-summary');

$I->amGoingTo('fill form with correct data');
$page->send('111111', '111111', '111111');
$I->expectTo('be redirected to signin page');
$I->seeInCurrentUrl('/signin');

TestCommon::logMeOut($I);