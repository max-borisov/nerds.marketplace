<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers;
use app\models\Category;
use app\components\Utility;

class CategoryController extends Controller
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
        $data = Category::find()->orderBy('id ASC')->all();
        return $this->render('index', ['data' => $data]);
    }

    public function actionCreate()
    {
        $model = new Category();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save(false)) {
                Yii::$app->session->setFlash('category_create_success', 'A new category has been created.');
                $this->redirect('/category');
            }
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = Category::find()->where('id = :id', [':id' => $id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save(false)) {
                Yii::$app->session->setFlash('category_update_success', 'Category title has been updated.');
                $this->redirect('/category/index');
            }
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete()
    {
//        $model = new Category();
        /*$model = new Category();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save(false)) {
                $this->refresh();
            }
        }*/
//        return $this->render('update', ['model' => $model]);
    }
}
