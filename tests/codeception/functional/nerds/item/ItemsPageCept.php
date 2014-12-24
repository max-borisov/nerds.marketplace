<?php

use tests\common\TestCommon;
use app\components\HelperPage;

$scenario->group('all');
$I = new FunctionalTester($scenario);

TestCommon::logMeIn($I);

$I->wantTo('ensure that items page works');
$I->amOnPage('/items');

$I->expectTo('see correct title');
$I->see(HelperPage::USER_ITEMS_PAGE_HEADER, 'h1');

$I->seeElement('.used-item-row');
$I->seeLink('Edit');
$I->seeLink('Delete');

TestCommon::logMeOut($I);