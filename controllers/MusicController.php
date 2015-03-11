<?php

namespace app\controllers;

use app\models\Music;
use Yii;
use yii\data\Pagination;

class MusicController extends \app\controllers\AppController
{
    public function actionIndex()
    {
        $query = Music::find()->select('id, title, post_date')->orderBy('post_date DESC');
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
        $music = Music::find()->where('id = :id', [':id' => $id])->one();
        if (!$music) {
            $this->redirect('/music');
        }
        return $this->render('view', ['music' => $music]);
    }
}