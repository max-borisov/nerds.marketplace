<?php

namespace app\controllers;

use app\components\HelperBase;
use app\models\SignUpForm;
use app\models\SignInForm;
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
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['signup', 'signin'],
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
                'secret'        => HelperBase::getParam('phpBBExternalRegistrationSecret'),
            ];
            $url = HelperBase::getParam('host') . '/' . HelperBase::getParam('phpBBExternalRegistrationScriptName');
            $response = HelperBase::curl( $url, [
                'method' => 'post',
                'post_fields' => $params,
            ]);

            if (!$response) {
                Yii::$app->session->setFlash('signup_error', 'Some errors appeared. Please, try to sign up later.');
            } else {
                Yii::$app->session->setFlash('signup_success', 'Your account has been registered. Please, sign in to continue.');
                $this->redirect('/signin');
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
}
