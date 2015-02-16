<?php

$scenario->group('all');
$I = new FunctionalTester($scenario);
$I->wantTo('ensure that stat page works');

$I->amOnPage('/stat');
$I->see('Items', 'th');
$I->see('News', 'th');
$I->see('Reviews', 'th');

