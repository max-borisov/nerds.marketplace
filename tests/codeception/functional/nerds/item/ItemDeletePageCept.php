<?php

use tests\common\TestCommon;
use app\components\HelperPage;

$scenario->group('all');
$I = new FunctionalTester($scenario);

TestCommon::logMeIn($I);

$I->wantTo('ensure that delete item link works');
$I->amOnPage('/item/delete/2');

$I->seeElement('.alert.alert-success');
$I->see('Item has been deleted');

$I->wantTo('ensure that user can\'t delete not his items');
$I->amOnPage('/item/delete/4');
$I->see(HelperPage::FRONT_PAGE_HEADER);

TestCommon::logMeOut($I);