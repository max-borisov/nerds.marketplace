<?php

$scenario->group('all');
$I = new FunctionalTester($scenario);
$I->wantTo('ensure that review view page works');

$I->amOnPage('/reviews/view/1');
$I->seeLink('Back', '/reviews');

