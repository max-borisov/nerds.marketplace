<?php

use tests\codeception\_pages\nerds\CategoryPage;
use tests\common\TestCommon;
use app\components\HelperPage;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that category page works');
CategoryPage::openBy($I);

$I->wantTo('ensure that unauthorized users are redirected to SignIn page');
$I->see(HelperPage::SIGN_IN_PAGE_HEADER, 'h2');

TestCommon::logMeIn($I);

CategoryPage::openBy($I);
$I->expect('page has a proper title');
$I->see(HelperPage::CATEGORIES_PAGE_HEADER, 'h1');

$I->wantTo('ensure that New category button works');
$I->click('a[type="button"]');
$I->expect('new page has a proper title');
$I->see(HelperPage::ADD_NEW_CATEGORY_PAGE_HEADER, 'h1');

CategoryPage::openBy($I);
$I->wantTo('ensure that Update category link works');
$I->click('#first-link', 'table');
$I->expect('new page has a proper title');
$I->see(HelperPage::UPDATE_CATEGORY_PAGE_HEADER, 'h1');

TestCommon::logMeOut($I);