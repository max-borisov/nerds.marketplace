<?php

use tests\codeception\_pages\nerds\CategoryUpdatePage;
use tests\commons\TestCommons;

$I = new FunctionalTester($scenario);
TestCommons::logMeIn($I);

$I->wantTo('ensure that update category page works');
$page = CategoryUpdatePage::openBy($I);

$I->expectTo('see correct title');
$I->see('Updating category', 'h1');

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

TestCommons::logMeOut($I);