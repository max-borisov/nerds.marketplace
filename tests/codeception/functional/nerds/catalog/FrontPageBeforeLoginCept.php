<?php

use app\components\HelperPage;

$scenario->group('all');
$I = new FunctionalTester($scenario);
$I->wantTo('ensure that front page works');

$I->amOnPage(Yii::$app->homeUrl);
$I->see(HelperPage::FRONT_PAGE_HEADER, 'h1');

//$I->wantTo('ensure that additional top menu links are hidden');
//$I->dontSeeLink('Your items', '/items');

$I->wantTo('ensure that there is SignIn link on the page');
$I->seeLink('Sign In', '/signin');
$I->amGoingTo('click SignIn link');
$I->click('Sign In');
$I->see(HelperPage::SIGN_IN_PAGE_HEADER, 'h1');

//\Codeception\Util\Debug::debug(Yii::$app->homeUrl);
//\Codeception\Util\Debug::debug(444);