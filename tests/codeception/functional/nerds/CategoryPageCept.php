<?php

use tests\codeception\_pages\nerds\CategoryPage;
use tests\commons\TestCommons;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that category page works');
CategoryPage::openBy($I);

$I->wantTo('ensure that unauthorized users are redirected to SignIn page');
$I->see('Please sign in', 'h2');

TestCommons::logMeIn($I);

CategoryPage::openBy($I);
$I->expect('page has a proper title');
$I->see('Categories', 'h1');

$I->wantTo('ensure that New category button works');
$I->click('a[type="button"]');
$I->expect('new page has a proper title');
$I->see('Creating category', 'h1');

CategoryPage::openBy($I);
$I->wantTo('ensure that Update category link works');
$I->click('#first-link', 'table');
$I->expect('new page has a proper title');
$I->see('Updating category', 'h1');

TestCommons::logMeOut($I);