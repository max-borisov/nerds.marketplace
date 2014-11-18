<?php

namespace app\controllers;

use app\components\HelperBase;
use app\models\SignUpForm;
use Yii;
use yii\web\Controller;
//use yii\helpers;
//use app\models\Category;

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
//        $data = Category::find()->orderBy('id ASC')->all();
//        return $this->render('index', ['data' => $data]);
        $model = new SignUpForm();
        $request = Yii::$app->request;


//        \app\components\HelperBase::dump(HelperBase::getParam('phpBBForumPath'));


        if ($request->isPost
            && $model->load($request->post())
            && $model->validate()) {
            \app\components\HelperBase::dump($request->post());
        }

        return $this->render('index', ['model' => $model]);
    }
}
