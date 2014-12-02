<?php
namespace tests\commons;
use Yii;

class TestCommons
{
    const FRONT_PAGE_HEADER             = 'Used items catalog';
    const SIGN_IN_PAGE_HEADER           = 'Sign in';
    const SIGN_UP_PAGE_HEADER           = 'Sign up';
    const CATEGORIES_PAGE_HEADER        = 'Categories';
    const ADD_NEW_CATEGORY_PAGE_HEADER  = 'Creating category';
    const UPDATE_CATEGORY_PAGE_HEADER   = 'Updating category';
    const NEW_ITEM_PAGE_HEADER          = 'Adding used item';

    public static function logMeIn($I)
    {
        $I->wantTo('ensure user is guest');
        $I->assertTrue(Yii::$app->user->isGuest);

        $form = new \app\models\SignInForm();
        $form->email = 'new_max@bk.ru';
        $I->assertTrue($form->login());

        $I->wantTo('ensure user is not guest');
        $I->assertFalse(Yii::$app->user->isGuest);
    }

    public static function logMeOut($I)
    {
        $I->wantTo('ensure user is guest again');
        $I->assertTrue(Yii::$app->user->logout());
        $I->assertTrue(Yii::$app->user->isGuest);
    }

    public static function categoryForm($actor, $categoryTitle)
    {
        $actor->fillField('input[type="text"]', $categoryTitle);
        $actor->click('input[type="submit"]');
    }
}