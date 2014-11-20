<?php

namespace app\controllers;

//use app\components\HelperBase;
//use app\models\SignUpForm;
use app\models\SignInForm;
use Yii;
use yii\web\Controller;

class SignInController extends Controller
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
        $model = new SignInForm();
        $request = Yii::$app->request;

        if ($request->isPost
            && $model->load($request->post())
            && $model->validate()) {

        }

        return $this->render('index', ['model' => $model]);
    }
}
