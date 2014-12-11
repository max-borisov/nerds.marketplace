<?php

use tests\codeception\_pages\nerds\CategoryUpdatePage;
use tests\common\TestCommon;
use app\components\HelperPage;

$I = new FunctionalTester($scenario);
TestCommon::logMeIn($I);

$I->wantTo('ensure that update category page works');
$page = CategoryUpdatePage::openBy($I);

$I->expectTo('see correct title');
$I->see(HelperPage::UPDATE_CATEGORY_PAGE_HEADER, 'h1');

$I->amGoingTo('try to set empty category title');
$page->sendForm('');
$I->expectTo('see validations errors');
$I->see('Title: cannot be blank');

$I->amGoingTo('try to set normal category title');
$page->sendForm('New Mac Headset ' . time());
$I->expectTo('redirect to category list page');
$I->seeCurrentUrlEquals('/category');
$I->expectTo('see success message');
$I->see('Category title has been updated');

TestCommon::logMeOut($I);