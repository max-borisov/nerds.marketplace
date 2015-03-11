<?php

namespace app\controllers;

use app\models\Tv;
use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\controllers\AppController;

class TvController extends AppController
{
    public function actionIndex()
    {
        $query = Tv::find()->select('id, title, post_date')->orderBy('post_date DESC');
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
        $tv = Tv::find()->where('id = :id', [':id' => $id])->one();
        if (!$tv) {
            $this->redirect('/tv');
        }
        return $this->render('view', ['tv' => $tv]);
    }
}