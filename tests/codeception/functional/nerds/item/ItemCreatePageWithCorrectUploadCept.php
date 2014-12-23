<?php

use tests\codeception\_pages\nerds\ItemCreatePage;
use tests\common\TestCommon;
use app\components\HelperPage;

$I = new FunctionalTester($scenario);

TestCommon::logMeIn($I);

$I->wantTo('ensure that add item page works');
$page = ItemCreatePage::openBy($I);

$I->expectTo('see correct title');
$I->see(HelperPage::NEW_ITEM_PAGE_HEADER, 'h1');

$I->amGoingTo('to test fields validation');
$params = [
    'warranty'      => 1,
    'invoice'       => 1,
    'packaging'     => 1,
    'manual'        => 1,
    'title'         => 'New item ' . date('d/m H:i'),
    'type_id'       => 1,
    'description'   => 'short description',
    'price'         => 100,
    'category_id'   => 1,
];
$page->fillForm($params);
$I->amGoingTo('to attache preview');
$I->attachFile('input[type="file"]', 'preview.jpg');
$I->click('input[type="submit"]');

$I->expectTo('see success message');
$I->see('A new item has been added');

TestCommon::logMeOut($I);