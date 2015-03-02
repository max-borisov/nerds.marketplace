<?php

use tests\codeception\_pages\nerds\ItemCreatePage;
use tests\common\TestCommon;
use app\components\HelperPage;


$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that page works');

TestCommon::logMeIn($I);

//$I->assertTrue(Yii::$app->user->isGuest);

//$loginPage = LoginPage::openBy($I);

/*$I->see('Login', 'h1');

$I->amGoingTo('try to login with empty credentials');
$loginPage->login('', '');
$I->expectTo('see validations errors');
$I->see('Username cannot be blank.');
$I->see('Password cannot be blank.');

$I->amGoingTo('try to login with wrong credentials');
$loginPage->login('admin', 'wrong');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->expectTo('see validations errors');
$I->see('Incorrect username or password.');

$I->amGoingTo('try to login with correct credentials');
$loginPage->login('admin', 'admin');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->expectTo('see user info');
$I->see('Logout (admin)');*/



#$I = new FunctionalTester($scenario);

#TestCommon::logMeIn($I);

$I->wantTo('ensure that add item page works');
$page = ItemCreatePage::openBy($I);

$I->expectTo('see correct title');
$I->see(HelperPage::NEW_ITEM_PAGE_HEADER, 'h1');

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
    'ad_type_id'    => 1,
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

//$I->am()

//$I->attachFile('input[type="file"]', 'img.jpg');
//$I->attachFile('input[type="file"]', 'file.txt');
$I->attachFile('#upload', 'file.txt');
//$I->attachFile('#upload', 'img.jpg');

$page->sendForm($params);

$I->expectTo('see success message');
$I->see('A new item has been added');

TestCommon::logMeOut($I);