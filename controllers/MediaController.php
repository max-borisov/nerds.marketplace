<?php

namespace app\controllers;

use app\models\Media;
use Yii;
use yii\data\Pagination;

class MediaController extends \app\controllers\AppController
{
    public function actionIndex()
    {
        $query = Media::find()->select('id, title, post_date')->orderBy('post_date DESC');
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
        $media = Media::find()->where('id = :id', [':id' => $id])->one();
        if (!$media) {
            $this->redirect('/media');
        }
        return $this->render('view', ['media' => $media]);
    }
}