<?php

use tests\common\TestCommon;
use app\components\HelperPage;

$I = new FunctionalTester($scenario);
TestCommon::logMeIn($I);

$I->wantTo('ensure that view tem page works');

$I->amOnPage('/item/view/1');
$I->expectTo('see Back button');
$I->seeElement('a.btn');
$I->expectTo('see table with item info');
$I->seeElement('table.table');

$I->wantTo('click to Back button');
$I->click('Back');
$I->expectTo('to be redirected to front page');
$I->see(HelperPage::FRONT_PAGE_HEADER, 'h1');
$I->seeCurrentUrlEquals('/');

TestCommon::logMeOut($I);
