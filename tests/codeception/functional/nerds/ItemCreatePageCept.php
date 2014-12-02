<?php

use tests\codeception\_pages\nerds\ItemCreatePage;
use tests\commons\TestCommons;

$I = new FunctionalTester($scenario);
TestCommons::logMeIn($I);

$I->wantTo('ensure that add item page works');
$page = ItemCreatePage::openBy($I);

$I->expectTo('see correct title');
$I->see(TestCommons::NEW_ITEM_PAGE_HEADER, 'h1');

$I->amGoingTo('to add empty form');
$page->sendForm();
$I->expectTo('see validations errors');
$I->see('Warranty: cannot be blank.');
$I->see('Invoice: cannot be blank.');
$I->see('Price: cannot be blank.');
$I->see('Category: cannot be blank.');

$I->amGoingTo('to test fields validation');
$params = [
    'warranty'      => 1,
    'invoice'       => 1,
    'packaging'     => 1,
    'manual'        => 1,
    'title'         => 'New item ' . date('d/m H:i'),
    'type_id'       => 1,
    'description'   => 'short description',
];
$page->sendForm($params);
$I->expectTo('see 2 validations errors');
$I->see('Price: cannot be blank.');
$I->see('Category: cannot be blank.');

$I->amGoingTo('to fill all fields');
$params = array_merge($params, [
    'price'         => 100,
    'category_id'   => 1,
]);
$page->sendForm($params);
$I->expectTo('see success message');
$I->see('A new item has been added');

TestCommons::logMeOut($I);