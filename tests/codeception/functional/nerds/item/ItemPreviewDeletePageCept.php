<?php

use tests\common\TestCommon;
use app\components\HelperPage;

$scenario->group('all');
$I = new FunctionalTester($scenario);

TestCommon::logMeIn($I);

$I->wantTo('ensure that delete item preview link works');
$I->amOnPage('/item/preview/delete/3');

$I->seeElement('.alert.alert-success');
$I->see('Preview has been delete');
$I->expectTo('see Edit item page header');
$I->see(HelperPage::EDIT_ITEM_PAGE_HEADER, 'h1');

TestCommon::logMeOut($I);