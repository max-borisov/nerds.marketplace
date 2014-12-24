<?php

use tests\common\TestCommon;
use app\components\HelperPage;

$scenario->group('upload');
$I = new FunctionalTester($scenario);

TestCommon::logMeIn($I);

$I->wantTo('ensure that upload preview works for edit item page');
$I->amOnPage('/item/edit/6');

$I->expectTo('see correct title');
$I->see(HelperPage::EDIT_ITEM_PAGE_HEADER, 'h1');

$I->amGoingTo('Attache incorrect file');
$I->attachFile('input[type="file"]', 'file.txt');
$I->click('#form-upload-images input[type="submit"]');
$I->expectTo('see error message');
$I->see('Please fix the following errors:');
$I->see('Only files with these extensions are allowed: jpg, png');

TestCommon::logMeOut($I);