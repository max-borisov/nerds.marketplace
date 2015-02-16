<?php

$scenario->group('all');
$I = new FunctionalTester($scenario);
$I->wantTo('ensure that news catalog page works');

$I->amOnPage('/news');
$I->see('news', 'p');
$I->see('Date', 'th');
$I->see('Title', 'th');

