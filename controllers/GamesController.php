<?php

namespace app\controllers;

use app\models\Game;
use Yii;
use yii\data\Pagination;

class GamesController extends \app\controllers\AppController
{
    public function actionIndex()
    {
        $query = Game::find()->select('id, title, post_date')->orderBy('post_date DESC');
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
        $game = Game::find()->where('id = :id', [':id' => $id])->one();
        if (!$game) {
            $this->redirect('/games');
        }
        return $this->render('view', ['game' => $game]);
    }
}