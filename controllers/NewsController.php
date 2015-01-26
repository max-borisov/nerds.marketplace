<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\News;

use app\components\HelperBase;

class NewsController extends Controller
{
    public $layout = 'marketplace';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    /*[
                        'allow' => true,
                        'actions' => ['create', 'items', 'delete', 'edit', 'upload', 'deletepreview'],
                        'roles' => ['@'],
                    ],*/
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['?', '@'],
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

    public function actionIndex()
    {
        $data = News::find()->select('id, title, post_date')->all();
        return $this->render('index', ['data' => $data]);
    }

    // View item page
    public function actionView($id)
    {
        $news = News::find()->where('id = :id', [':id' => $id])->one();
//        HelperBase::dump($news->attributes);
        /*if (!$item) {
            $this->redirect('/');
        }*/
        return $this->render('view', ['news' => $news]);
    }
}