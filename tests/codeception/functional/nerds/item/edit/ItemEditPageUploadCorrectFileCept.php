<?php

use tests\common\TestCommon;
use app\components\HelperPage;

$scenario->group('all');
$I = new FunctionalTester($scenario);

TestCommon::logMeIn($I);

$I->wantTo('ensure that upload preview works for edit item page');
$I->amOnPage('/item/edit/1');

$I->expectTo('see correct title');
$I->see(HelperPage::EDIT_ITEM_PAGE_HEADER, 'h1');

$I->amOnPage('/item/edit/1');
$I->amGoingTo('Attache correct file');
$I->attachFile('input[type="file"]', 'preview.jpg');
$I->click('#form-upload-images input[type="submit"]');
$I->expectTo('see success message');
$I->seeElement('.alert-success');

TestCommon::logMeOut($I);