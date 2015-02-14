<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\Pagination;
use app\models\News;
use app\controllers\AppController;

class NewsController extends AppController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $query = News::find()->select('id, title, post_date')->orderBy('post_date DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $data = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', [
            'data' => $data,
            'pages' => $pages,
        ]);
    }

    // View item page
    public function actionView($id)
    {
        $news = News::find()->where('id = :id', [':id' => $id])->one();
        if (!$news) {
            $this->redirect('/news');
        }
        return $this->render('view', ['news' => $news]);
    }
}