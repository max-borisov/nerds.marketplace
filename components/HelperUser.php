<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\helpers\Html;

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

    public static function sendConfirmationEmail(\app\models\PhpbbUser $user)
    {
        $confirmLinkTxt = HelperBase::getParam('host') . '/confirm-email/1212121';
        $tplTxt = str_replace(
            ['{username}', '{url}'],
            [$user->username, $confirmLinkTxt],
            file_get_contents(Yii::getAlias('@app') . '/mail/confirmation/tpl.txt')
        );

        $confirmLinkHtml = Html::a($confirmLinkTxt, $confirmLinkTxt);
        $tplHtml = str_replace(
            ['{username}', '{url}'],
            [$user->username, $confirmLinkHtml],
            file_get_contents(Yii::getAlias('@app') . '/mail/confirmation/tpl.html')
        );

        $params = [
            'html' => $tplHtml,
            'text' => $tplTxt,
            'subject' => 'Nerds.dk SignUp confirmation',
            'to' => [
                [
//                    'email' => $user->user_email,
                    'email' => 'max.borisov@yahoo.com',
                    'name'  => $user->username,
                    'type'  => 'to'
                ]
            ],
        ];
        HelperBase::dump(Yii::$app->mailer->send($params));
    }
}