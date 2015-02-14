<?php

namespace app\controllers;

use app\models\Review;
use app\models\ReviewType;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\Pagination;
use app\controllers\AppController;

class ReviewsController extends AppController
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
        $query = Review::find()->select('id, title, post_date, review_type_id')->orderBy('post_date DESC')->with('type');
        $category = null;
        if ($category = Yii::$app->request->get('category')) {
            if (ReviewType::find()->where('id = :id', [':id' => $category])->exists()) {
                $query->where('review_type_id = :category', [':category' => $category]);
            } else {
                $category = null;
            }
        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $data = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', [
            'data'      => $data,
            'pages'     => $pages,
            'category'  => $category,
        ]);
    }

    // View item page
    public function actionView($id)
    {
        $review = Review::find()->where('id = :id', [':id' => $id])->one();
        if (!$review) {
            $this->redirect('/review');
        }
        return $this->render('view', ['review' => $review]);
    }
}