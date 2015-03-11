<?php

namespace app\controllers;

use app\models\Radio;
use Yii;
use yii\data\Pagination;

class RadioController extends \app\controllers\AppController
{
    public function actionIndex()
    {
        $query = Radio::find()->select('id, title, post_date')->orderBy('post_date DESC');
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
        $radio = Radio::find()->where('id = :id', [':id' => $id])->one();
        if (!$radio) {
            $this->redirect('/radio');
        }
        return $this->render('view', ['radio' => $radio]);
    }
}