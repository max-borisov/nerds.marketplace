<?php

use tests\codeception\_pages\nerds\ItemEditPage;
use tests\common\TestCommon;
use app\components\HelperPage;

$I = new FunctionalTester($scenario);

TestCommon::logMeIn($I);

$I->wantTo('ensure that edit item page works');
$page = ItemEditPage::openBy($I);

$I->expectTo('see correct title');
$I->see(HelperPage::EDIT_ITEM_PAGE_HEADER, 'h1');
$I->amGoingTo('to save current form');
$I->click('Save');

$I->expectTo('see success message');
$I->see('Item data has been updated.');
$I->seeCurrentUrlEquals('/items');

TestCommon::logMeOut($I);