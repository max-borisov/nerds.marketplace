<?php

use tests\common\TestCommon;
use app\components\HelperPage;

$scenario->group('all');
$I = new FunctionalTester($scenario);
$I->wantTo('ensure that delete category page works');

TestCommon::logMeIn($I);

// Delete Category with no attached items
$I->amOnPage('/category/delete/6');
$I->expect('to be redirected to categories page');
$I->seeCurrentUrlEquals('/category');
$I->expectTo('see success message');
$I->seeElement('.alert-success');

// Delete Category with attached items
$I->amOnPage('/category/delete/7');
$I->expect('to be redirected to categories page');
$I->seeCurrentUrlEquals('/category');
$I->expectTo('see success message');
$I->seeElement('.alert-success');

// Go to front page
$I->wantTo('ensure that items catalog page works after category has been deleted');
$I->amOnPage('/index-test.php');
$I->expectTo('see correct header');
$I->see(HelperPage::FRONT_PAGE_HEADER, 'h1');

// Go to user items page
/*$I->wantTo('ensure that user items page works after category has been deleted');
$I->amOnPage('/items');
$I->expectTo('see correct header');
$I->see(HelperPage::USER_ITEMS_PAGE_HEADER, 'h1');*/

TestCommon::logMeOut($I);