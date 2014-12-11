<?php
namespace app\components;

use Yii;
use yii\base\Component;

class HelperUser extends Component
{
    public static function isGuest()
    {
        return Yii::$app->user->isGuest;
    }

    public static function uid()
    {
        return Yii::$app->user->id;
    }

    public static function uIdentity()
    {
        return Yii::$app->user->identity;
    }

    public static function uIdentityParam($key)
    {
        if (!empty(Yii::$app->user->identity)
            && isset(Yii::$app->user->identity[$key])) {
            return Yii::$app->user->identity->$key;
        }
        return null;
    }
}