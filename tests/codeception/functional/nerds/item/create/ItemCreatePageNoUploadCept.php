<?php

use tests\codeception\_pages\nerds\ItemCreatePage;
use tests\common\TestCommon;
use app\components\HelperPage;
use \app\models\ExternalSite;

$scenario->group('all');
$I = new FunctionalTester($scenario);

TestCommon::logMeIn($I);

$I->wantTo('ensure that add item page works');
$page = ItemCreatePage::openBy($I);

$I->expectTo('see correct title');
$I->see(HelperPage::NEW_ITEM_PAGE_HEADER, 'h1');

$I->amGoingTo('to add empty form');
$page->fillForm();
$I->click('input[type="submit"]');

$I->expectTo('see validations errors');
$I->see('Title: cannot be blank.');
$I->see('Description: cannot be blank.');
$I->see('Category: cannot be blank.');

$I->amGoingTo('to test fields validation');
$params = [
    'warranty'      => 1,
    'invoice'       => 1,
    'packaging'     => 1,
    'manual'        => 1,
    'title'         => 'New item ' . date('d/m H:i'),
    'site_id'       => ExternalSite::NERDS,
    's_item_id'     => rand(20, 1000),
    'ad_type_id'    => 1,
    'description'   => 'short description',
];
$page->fillForm($params);
$I->click('input[type="submit"]');

$I->expectTo('see 2 validations errors');
$I->see('Category: cannot be blank.');

$I->amGoingTo('to fill all fields');
$params = array_merge($params, [
    'price'         => 100,
    'category_id'   => 1,
]);
$page->fillForm($params);
$I->click('input[type="submit"]');

$I->expectTo('see success message');
$I->see('A new item has been added');

TestCommon::logMeOut($I);