<?php

use tests\common\TestCommon;

$scenario->group('all');
$I = new FunctionalTester($scenario);
$I->wantTo('ensure that logout link works');

$homeUrl = Yii::$app->homeUrl;

$I->amOnPage($homeUrl);
$I->wantTo('ensure that unauthorized users can\'t see logout link');
$I->dontSeeLink('Logout');

TestCommon::logMeIn($I);

$I->amOnPage($homeUrl);

$I->wantTo('ensure user is not guest');
$I->assertFalse(Yii::$app->user->isGuest);

$I->seeLink('Logout', '/logout');
$I->click('Logout');
$I->seeCurrentUrlEquals(Yii::$app->homeUrl);

TestCommon::logMeOut($I);