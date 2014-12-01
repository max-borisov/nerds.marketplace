<?php
class TestCommons
{
    public static function logMeIn()
    {
        $form = new \app\models\SignInForm();
        $form->email = 'new_max@bk.ru';
        return $form->login();
    }

    public static function logMeOut()
    {
        return Yii::$app->user->logout();
    }
}