<?php

use tests\codeception\_pages\nerds\SearchItemPage;
use tests\commons\TestCommons;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that search items page works');

$searchPage = SearchItemPage::openBy($I);
$I->wantTo('ensure page has a proper header');
$I->see(TestCommons::FRONT_PAGE_HEADER, 'h1');

$params = [];
$I->amGoingTo('fill form with empty data');
$searchPage->search($params);
$I->expectTo('see default list of items');
$I->seeElement('.used-item-row');

$params = [
    'warranty' => 1,
    'packaging' => 1,
    'manual' => 1,
    'price_min' => 0,
    'price_max_text' => 10000000,
];
$I->amGoingTo('fill form with correct data, but without search text');
$searchPage->search($params);
$I->expectTo('see list of items');
$I->seeElement('.used-item-row');

$I->amGoingTo('set search text');
$params['search_text'] = 'bla bla bla';
$searchPage->search($params);
$I->expectTo('not see any items');
$I->cantSeeElement('.used-item-row');

$I->amGoingTo('reset search filter');
$I->click('Reset filter');
$I->expectTo('see default items list');
$I->seeElement('.used-item-row');