<?php

namespace app\controllers;

use app\models\Movie;
use Yii;
use yii\data\Pagination;

class MoviesController extends \app\controllers\AppController
{
    public function actionIndex()
    {
        $query = Movie::find()->select('id, title, post_date')->orderBy('post_date DESC');
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

    public function actionView($id)
    {
        $movies = Movie::find()->where('id = :id', [':id' => $id])->one();
        if (!$movies) {
            $this->redirect('/movies');
        }
        return $this->render('view', ['movies' => $movies]);
    }
}