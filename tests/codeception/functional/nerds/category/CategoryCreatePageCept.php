<?php

use tests\codeception\_pages\nerds\CategoryCreatePage;
use tests\common\TestCommon;
use app\components\HelperPage;

$scenario->group('all');
$I = new FunctionalTester($scenario);

TestCommon::logMeIn($I);

$I->wantTo('ensure that create category page works');
$page = CategoryCreatePage::openBy($I);

$I->expectTo('see correct title');
$I->see(HelperPage::ADD_NEW_CATEGORY_PAGE_HEADER, 'h1');

$I->amGoingTo('try to add empty category title');
$page->sendForm('');
$I->expectTo('see validations errors');
$I->see('Title: cannot be blank');

$I->amGoingTo('try to add normal category title');
$page->sendForm('Mac Headset ' . time());
$I->expectTo('redirect to category list page');
$I->seeCurrentUrlEquals('/category');
$I->expectTo('see success message');
$I->see('A new category has been created');

TestCommon::logMeOut($I);