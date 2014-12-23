<?php

use app\components\HelperPage;
use tests\common\TestCommon;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that front page works after login');

TestCommon::logMeIn($I);

$I->amOnPage(Yii::$app->homeUrl);
$I->see(HelperPage::FRONT_PAGE_HEADER, 'h1');

$I->dontSeeLink('Sign In', '/signin');
$I->expectTo('see additional top menu links');
$I->seeLink('Add new item', '/item/create');
$I->seeLink('Your items', '/items');
$I->seeLink('Forum profile');

$I->click('Your items', '.nav');
$I->see(HelperPage::USER_ITEMS_PAGE_HEADER, 'h1');

TestCommon::logMeOut($I);

