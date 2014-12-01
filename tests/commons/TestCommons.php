<?php
namespace tests\commons;
use Yii;

class TestCommons
{
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