<?php

$scenario->group('all');
$I = new FunctionalTester($scenario);
$I->wantTo('ensure that news view page works');

$I->amOnPage('/news/view/1');
$I->seeLink('Back', '/news');

