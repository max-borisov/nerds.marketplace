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

    public static function sendConfirmationEmail(\app\models\User $user)
    {
        $confirmLinkTxt = HelperBase::getParam('host') . '/confirm-email/' . $user->yii_confirmation_hash;
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
                    'email' => $user->user_email,
                    'name'  => $user->username,
                    'type'  => 'to'
                ]
            ],
        ];
        return Yii::$app->mailer->send($params);
    }

    public static function sendPasswordUpdateNotification(\app\models\User $user)
    {
        $tplTxt = str_replace(
            '{username}',
            $user->username,
            file_get_contents(Yii::getAlias('@app') . '/mail/update_password/tpl.txt')
        );
        $tplHtml = str_replace(
            '{username}',
            $user->username,
            file_get_contents(Yii::getAlias('@app') . '/mail/update_password/tpl.html')
        );
        $params = [
            'html' => $tplHtml,
            'text' => $tplTxt,
            'subject' => 'Nerds.dk Password update notification',
            'to' => [
                [
                    'email' => $user->user_email,
                    'name'  => $user->username,
                    'type'  => 'to'
                ]
            ],
        ];
        return Yii::$app->mailer->send($params);
    }

    public static function getHash()
    {
        return md5(uniqid());
    }

    public static function parseSaveUserResponse($response)
    {
        // If response contains 'error' message
        if ($response && is_string($response) && preg_match('/error/i', $response)) {
            return false;
        }
        return true;
    }
}