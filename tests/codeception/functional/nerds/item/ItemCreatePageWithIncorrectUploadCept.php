<?php

use tests\codeception\_pages\nerds\ItemCreatePage;
use tests\common\TestCommon;
use app\components\HelperPage;

return;

$I = new FunctionalTester($scenario);

TestCommon::logMeIn($I);

sleep(3);

$I->wantTo('ensure that add item page works');
$page = ItemCreatePage::openBy($I);

$I->expectTo('see correct title');
$I->see(HelperPage::NEW_ITEM_PAGE_HEADER, 'h1');

$I->amGoingTo('to test fields validation');
$page->fillForm();
$I->amGoingTo('to attache incorrect file');
//$I->fillField('input[type="file"]', '');
$I->attachFile('input[type="file"]', 'README.md');
$I->click('input[type="submit"]');

$I->expectTo('see uploaded file validation error');
$I->see('Please fix the following errors:');
$I->see('Only files with these extensions are allowed: jpg, png');

TestCommon::logMeOut($I);