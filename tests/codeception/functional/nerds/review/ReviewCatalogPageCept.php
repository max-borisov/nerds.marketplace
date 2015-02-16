<?php

$scenario->group('all');
$I = new FunctionalTester($scenario);
$I->wantTo('ensure that reviews catalog page works');

$I->amOnPage('/reviews');
$I->see('reviews', 'p');
$I->see('Date', 'th');
$I->see('Category', 'th');
$I->see('Title', 'th');

