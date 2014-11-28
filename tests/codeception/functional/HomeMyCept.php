<?php

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('Used items catalog');
$I->seeLink('Sign In');

//\Codeception\Util\Debug::debug(Yii::$app->homeUrl);
//\Codeception\Util\Debug::debug(444);



/*$I = new FunctionalTester($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('My Company');
$I->seeLink('About');
$I->click('About');
$I->see('This is the About page.');*/
