<?php

namespace app\controllers;

use app\components\HelperBase;
use app\models\SignUpForm;
use Yii;
use yii\web\Controller;

class SignUpController extends Controller
{
    public $layout = 'marketplace';

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new SignUpForm();
        $request = Yii::$app->request;

        if ($request->isPost
            && $model->load($request->post())
            && $model->validate()) {

            $params = [
                'name'      => $model->username,
                'email'     => $model->email,
                'password'  => $model->password,
                'secret'    => HelperBase::getParam('phpBBExternalRegistrationSecret'),
            ];
            $url = HelperBase::getParam('host') . '/' . HelperBase::getParam('phpBBExternalRegistrationScriptName');
            $response = HelperBase::curl( $url, [
                'method' => 'post',
                'post_fields' => $params,
            ]);

            if (!$response) {
                Yii::$app->session->setFlash('signup_error', 'Some errors appeared. Please, try to sign up later.');
            } else {
                // @todo Redirect to SignIn page
                $this->redirect('/signin');
            }
        }
        return $this->render('index', ['model' => $model]);
    }
}
