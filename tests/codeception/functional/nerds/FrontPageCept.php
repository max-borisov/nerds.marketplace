<?php

$I = new FunctionalTester($scenario);
$title = 'Used items catalog';
$I->wantTo('ensure that front page works');

$I->amOnPage(Yii::$app->homeUrl);
$I->see($title, 'h1');

$I->wantTo('ensure that there is SignIn link on the page');
$I->seeLink('Sign In', '/signin');
$I->amGoingTo('click SignIn link');
$I->click('Sign In');
$I->see('Sign in', 'h2');

//\Codeception\Util\Debug::debug(Yii::$app->homeUrl);
//\Codeception\Util\Debug::debug(444);
