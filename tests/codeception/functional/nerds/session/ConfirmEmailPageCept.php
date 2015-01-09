<?php

$scenario->group('all');
$I = new FunctionalTester($scenario);
$I->wantTo('ensure email confirmation page works');

// User fixture id 4. Account is not activated.
$I->amOnPage('/confirm-email/826eadbdf2778397b2499804bacd57ea');
$I->expectTo('see success activation message');
$I->seeCurrentUrlEquals('/signin');

// User fixture id 3. Account is activated.
$I->amOnPage('/confirm-email/eafaedcf9e4b2d887bfbceea96c625ed');
$I->expectTo('see success activation message');
$I->seeCurrentUrlEquals('/signin');