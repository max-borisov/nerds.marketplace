<?php

namespace app\controllers;

use app\components\HelperBase;
use app\components\HelperUser;
use app\models\PhpbbUser;
use app\models\SignUpForm;
use app\models\SignInForm;
use app\models\UpdatePasswordForm;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class SessionController extends Controller
{
    public $layout = 'marketplace';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['logout', 'updatepassword'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['signup', 'signin', 'confirmemail'],
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionSignup()
    {
        $model = new SignUpForm();
        $request = Yii::$app->request;

        if ($request->isPost
            && $model->load($request->post())
            && $model->validate()) {

            $params = [
                'name'          => $model->username,
                'email'         => $model->email,
                'password'      => $model->password,
                'yii_password'  => Yii::$app->security->generatePasswordHash($model->password),
                'yii_confirmation_hash' => HelperUser::getHash(),
                'secret'        => HelperBase::getParam('phpBBExternalRegistrationSecret'),
            ];
            $url = HelperBase::getParam('host') . '/' . HelperBase::getParam('phpBBExternalRegistrationScriptName');
            $response = HelperBase::curl( $url, [
                'method' => 'post',
                'post_fields' => $params,
            ]);
            if ($response && HelperUser::parseSaveUserResponse($response)) {
                $user = PhpbbUser::findByEmail($model->email);
                HelperUser::sendConfirmationEmail($user);
                Yii::$app->session->setFlash(
                    'signup_success',
                    'Your account has been created. Please, check your mailbox for confirmation email.'
                );
                $this->redirect('/signin');
            } else {
                Yii::$app->session->setFlash(
                    'signup_error',
                    'Some errors appeared. Please, try to sign up later.'
                );
                HelperBase::logger('Add new user error', null, ['response' => $response]);
            }
        }
        return $this->render('signUp', ['model' => $model]);
    }

    public function actionSignin()
    {
        $model = new SignInForm();
        $request = Yii::$app->request;

        if ($request->isPost
            && $model->load($request->post())
            && $model->validate()) {
            if ($model->login()) {
                $this->redirect($this->goHome());
            } else {
                // @todo Add flash message
            }
        }
        return $this->render('signIn', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        $this->goHome();
    }

    public function actionUpdatepassword()
    {
        $user = PhpbbUser::findOne(HelperUser::uid());
        $model = new UpdatePasswordForm();
        $model->setUser($user);
        $request = Yii::$app->request;

        if ($request->isPost
            && $model->load($request->post())
            && $model->validate()) {
            $user->yii_password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            if ($user->save(false)) {
                HelperUser::sendPasswordUpdateNotification($user);
                Yii::$app->user->logout();
            } else {
                HelperBase::logger('Password update error', null, ['uid' => HelperUser::uid()]);
            }
            $this->refresh();
        }
        return $this->render('updatePassword', ['model' => $model]);
    }

    public function actionConfirmemail($hash)
    {
        if (PhpbbUser::confirmEmail($hash)) {
            Yii::$app->session->setFlash('email_confirmation_success', 'Your email address has been confirmed and now you can log in to the system.');
        } else {
            Yii::$app->session->setFlash('email_confirmation_error', 'Email has not been confirmed.');
        }
        $this->redirect('/signin');
    }
}
