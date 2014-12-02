<?php

use tests\commons\TestCommons;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that front page works');

$I->amOnPage(Yii::$app->homeUrl);
$I->see(TestCommons::FRONT_PAGE_HEADER, 'h1');

$I->wantTo('ensure that there is SignIn link on the page');
$I->seeLink('Sign In', '/signin');
$I->amGoingTo('click SignIn link');
$I->click('Sign In');
$I->see(TestCommons::SIGN_IN_PAGE_HEADER, 'h2');

//\Codeception\Util\Debug::debug(Yii::$app->homeUrl);
//\Codeception\Util\Debug::debug(444);
